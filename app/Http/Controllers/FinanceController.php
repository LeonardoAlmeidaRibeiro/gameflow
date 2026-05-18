<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Exercise;
use App\Models\Finance;
use App\Models\FinancePaymentMethod;
use App\Models\TrainingDivision;
use App\Models\WorkoutProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FinanceController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user();
        $today = now()->startOfDay();
        $year = (int) $request->input('ano', $today->year);
        $month = (int) $request->input('mes', $today->month);

        $monthlyTotals = Finance::query()
            ->select('mes', 'tipo', DB::raw('SUM(valor) as total'))
            ->where('user_id', $user->id)
            ->where('ano', $year)
            ->where('status', '!=', 'cancelado')
            ->groupBy('mes', 'tipo')
            ->get();

        $receitasMensais = array_fill(0, 12, 0);
        $despesasMensais = array_fill(0, 12, 0);

        foreach ($monthlyTotals as $total) {
            $index = max(0, min(11, ((int) $total->mes) - 1));

            if ($total->tipo === 'receita') {
                $receitasMensais[$index] = (float) $total->total;
            }

            if ($total->tipo === 'despesa') {
                $despesasMensais[$index] = (float) $total->total;
            }
        }

        $monthQuery = Finance::query()
            ->where('finance.user_id', $user->id)
            ->where('finance.mes', $month)
            ->where('finance.ano', $year);

        $totalReceitas = (clone $monthQuery)
            ->where('tipo', 'receita')
            ->where('status', '!=', 'cancelado')
            ->sum('valor');

        $totalDespesas = (clone $monthQuery)
            ->where('tipo', 'despesa')
            ->where('status', '!=', 'cancelado')
            ->sum('valor');

        $categoryTotals = (clone $monthQuery)
            ->leftJoin('cad_bas_categoria', 'cad_bas_categoria.id', '=', 'finance.categoria_id')
            ->selectRaw("COALESCE(cad_bas_categoria.nome, 'Sem categoria') as label, SUM(finance.valor) as total")
            ->where('finance.tipo', 'despesa')
            ->where('finance.status', '!=', 'cancelado')
            ->groupByRaw("COALESCE(cad_bas_categoria.nome, 'Sem categoria')")
            ->orderByDesc('total')
            ->get();

        $statusLabels = [
            'pendente' => 'Pendente',
            'pago' => 'Pago',
            'cancelado' => 'Cancelado',
        ];

        $statusTotals = (clone $monthQuery)
            ->select('status', DB::raw('SUM(valor) as total'))
            ->groupBy('status')
            ->get();

        $financeAlerts = $this->dashboardFinanceAlerts($user->id, $today, (float) $totalReceitas, (float) $totalDespesas);
        $workoutChartData = $this->dashboardWorkoutChartData($user->id);

        return view('index', [
            'financeYear' => $year,
            'financeMonth' => $month,
            'dashboardTotals' => [
                'receitas' => (float) $totalReceitas,
                'despesas' => (float) $totalDespesas,
                'saldo' => (float) $totalReceitas - (float) $totalDespesas,
            ],
            'financeAlerts' => $financeAlerts,
            'financeChartData' => [
                'months' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                'receitas' => $receitasMensais,
                'despesas' => $despesasMensais,
                'categoryLabels' => $categoryTotals->pluck('label')->values(),
                'categorySeries' => $categoryTotals->pluck('total')->map(fn ($value) => (float) $value)->values(),
                'statusLabels' => $statusTotals->pluck('status')->map(fn ($status) => $statusLabels[$status] ?? ucfirst($status))->values(),
                'statusSeries' => $statusTotals->pluck('total')->map(fn ($value) => (float) $value)->values(),
            ],
            'workoutChartData' => $workoutChartData,
        ]);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $month = (int) $request->input('mes', now()->month);
        $year = (int) $request->input('ano', now()->year);

        $financeQuery = Finance::query()
            ->with(['categoria', 'paymentMethod'])
            ->where('user_id', $user->id)
            ->where('mes', $month)
            ->where('ano', $year);

        $financeCategories = Categoria::query()
            ->orderBy('nome')
            ->get();

        $paymentMethods = FinancePaymentMethod::query()
            ->where('user_id', $user->id)
            ->orderByDesc('ativo')
            ->orderBy('nome')
            ->get();

        $finances = (clone $financeQuery)
            ->orderByRaw('COALESCE(data_vencimento, created_at) DESC')
            ->orderByDesc('id')
            ->get();

        $totalReceitas = (clone $financeQuery)
            ->where('tipo', 'receita')
            ->where('status', '!=', 'cancelado')
            ->sum('valor');

        $totalDespesas = (clone $financeQuery)
            ->where('tipo', 'despesa')
            ->where('status', '!=', 'cancelado')
            ->sum('valor');

        $totalPendente = (clone $financeQuery)
            ->where('status', 'pendente')
            ->sum('valor');

        return view('finance.index', [
            'user' => $user,
            'finances' => $finances,
            'financeMonth' => $month,
            'financeYear' => $year,
            'totalReceitas' => $totalReceitas,
            'totalDespesas' => $totalDespesas,
            'saldoFinanceiro' => $totalReceitas - $totalDespesas,
            'totalPendente' => $totalPendente,
            'financeCategories' => $financeCategories,
            'paymentMethods' => $paymentMethods,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatedFinanceData($request);
        $this->applyPaymentMethodData($validated, $request);
        $recorrenciaQuantidade = (int) $request->input('recorrencia_quantidade', 1);

        $referenceDate = !empty($validated['data_vencimento'])
            ? Carbon::parse($validated['data_vencimento'])
            : now();

        $validated['user_id'] = $request->user()->id;
        $validated['mes'] = !empty($validated['data_vencimento'])
            ? $referenceDate->month
            : ($validated['mes'] ?? $referenceDate->month);
        $validated['ano'] = !empty($validated['data_vencimento'])
            ? $referenceDate->year
            : ($validated['ano'] ?? $referenceDate->year);
        $validated['recorrente'] = $request->boolean('recorrente');
        $validated['recorrencia_tipo'] = $validated['recorrente'] ? 'mensal' : null;
        $validated['recorrencia_valor_tipo'] = $validated['recorrente']
            ? ($validated['recorrencia_valor_tipo'] ?? 'fixo')
            : null;
        $validated['recorrencia_intervalo'] = $validated['recorrente'] ? 1 : 1;
        $validated['recorrencia_ate'] = $validated['recorrente']
            ? $referenceDate->copy()->addMonthsNoOverflow(max(0, $recorrenciaQuantidade - 1))->toDateString()
            : null;

        $finance = Finance::create($validated);

        if ($validated['recorrente'] && $recorrenciaQuantidade > 1) {
            $this->createMonthlyRecurrences($finance, $validated, $referenceDate, $recorrenciaQuantidade);
        }

        return redirect()
            ->route('finance.index', [
                'mes' => $validated['mes'],
                'ano' => $validated['ano'],
            ])
            ->with('status', 'Lançamento financeiro adicionado com sucesso.');
    }

    public function update(Request $request, Finance $finance)
    {
        abort_if($finance->user_id !== $request->user()->id, 404);

        $validated = $this->validatedFinanceData($request);
        $this->applyPaymentMethodData($validated, $request);
        $validated['recorrente'] = $request->boolean('recorrente');
        $validated['recorrencia_tipo'] = $validated['recorrente'] ? 'mensal' : null;
        $validated['recorrencia_valor_tipo'] = $validated['recorrente']
            ? ($validated['recorrencia_valor_tipo'] ?? 'fixo')
            : null;
        $validated['recorrencia_intervalo'] = $validated['recorrente'] ? 1 : 1;
        $validated['recorrencia_ate'] = $validated['recorrente'] ? $finance->recorrencia_ate : null;

        $finance->update($validated);

        return redirect()
            ->route('finance.index', [
                'mes' => $validated['mes'] ?? $finance->mes,
                'ano' => $validated['ano'] ?? $finance->ano,
            ])
            ->with('status', 'Lançamento financeiro atualizado com sucesso.');
    }

    public function destroy(Request $request, Finance $finance)
    {
        abort_if($finance->user_id !== $request->user()->id, 404);

        $month = $finance->mes;
        $year = $finance->ano;

        $finance->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Lançamento financeiro excluído com sucesso.',
            ]);
        }

        return redirect()
            ->route('finance.index', [
                'mes' => $month,
                'ano' => $year,
            ])
            ->with('status', 'Lançamento financeiro excluído com sucesso.');
    }

    public function storePaymentMethod(Request $request)
    {
        $validator = $this->paymentMethodValidator($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'paymentMethod')
                ->withInput()
                ->with('payment_method_modal', true);
        }

        FinancePaymentMethod::create(array_merge($validator->validated(), [
            'user_id' => $request->user()->id,
            'ativo' => $request->boolean('ativo', true),
        ]));

        return back()->with('status', 'Forma de pagamento cadastrada com sucesso.');
    }

    public function updatePaymentMethod(Request $request, FinancePaymentMethod $paymentMethod)
    {
        abort_if($paymentMethod->user_id !== $request->user()->id, 404);

        $validator = $this->paymentMethodValidator($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'paymentMethod')
                ->withInput()
                ->with('payment_method_modal', true);
        }

        $paymentMethod->update(array_merge($validator->validated(), [
            'ativo' => $request->boolean('ativo'),
        ]));

        return back()->with('status', 'Forma de pagamento atualizada com sucesso.');
    }

    public function destroyPaymentMethod(Request $request, FinancePaymentMethod $paymentMethod)
    {
        abort_if($paymentMethod->user_id !== $request->user()->id, 404);

        $paymentMethod->delete();

        return back()->with('status', 'Forma de pagamento excluída com sucesso.');
    }

    private function validatedFinanceData(Request $request): array
    {
        $request->merge([
            'valor' => $this->normalizeFinanceValue($request->input('valor')),
        ]);

        return $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'tipo' => ['required', 'in:receita,despesa'],
            'categoria_id' => ['nullable', 'integer', 'exists:cad_bas_categoria,id'],
            'valor' => ['required', 'numeric', 'min:0.01'],
            'mes' => ['nullable', 'integer', 'between:1,12'],
            'ano' => ['nullable', 'integer', 'between:2000,2100'],
            'status' => ['required', 'in:pendente,pago,cancelado'],
            'data_vencimento' => ['nullable', 'date'],
            'data_pagamento' => ['nullable', 'date'],
            'forma_pagamento' => ['nullable', 'string', 'max:255'],
            'payment_method_id' => [
                'nullable',
                Rule::exists('finance_payment_methods', 'id')->where(fn ($query) => $query->where('user_id', $request->user()->id)),
            ],
            'recorrente' => ['nullable', 'boolean'],
            'recorrencia_valor_tipo' => ['nullable', 'in:fixo,variavel'],
            'recorrencia_quantidade' => ['nullable', 'integer', 'between:1,60'],
            'observacoes' => ['nullable', 'string'],
        ]);
    }

    private function normalizeFinanceValue($value): string
    {
        $value = trim((string) $value);

        if (strpos($value, ',') !== false) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
        }

        return $value;
    }

    private function applyPaymentMethodData(array &$validated, Request $request): void
    {
        if (empty($validated['payment_method_id'])) {
            $validated['payment_method_id'] = null;
            return;
        }

        $paymentMethod = FinancePaymentMethod::query()
            ->where('user_id', $request->user()->id)
            ->find($validated['payment_method_id']);

        if ($paymentMethod) {
            $validated['forma_pagamento'] = $paymentMethod->display_name;
        }
    }

    private function paymentMethodValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'tipo' => ['required', 'in:credito,debito,carteira_digital,dinheiro'],
            'nome' => ['required', 'string', 'max:255'],
            'bandeira' => ['nullable', 'string', 'max:100'],
            'ultimos_digitos' => ['nullable', 'digits:4'],
            'ativo' => ['nullable', 'boolean'],
        ], [
            'tipo.required' => 'Informe o tipo da forma de pagamento.',
            'nome.required' => 'Informe o nome da forma de pagamento.',
            'ultimos_digitos.digits' => 'Informe exatamente 4 dígitos finais.',
        ]);
    }

    private function createMonthlyRecurrences(Finance $origin, array $validated, Carbon $referenceDate, int $quantity): void
    {
        for ($index = 1; $index < $quantity; $index++) {
            $nextReferenceDate = $referenceDate->copy()->addMonthsNoOverflow($index);
            $nextData = $validated;

            unset($nextData['data_pagamento']);

            $nextData['status'] = 'pendente';
            $nextData['mes'] = $nextReferenceDate->month;
            $nextData['ano'] = $nextReferenceDate->year;
            $nextData['data_pagamento'] = null;
            $nextData['recorrencia_origem_id'] = $origin->id;

            if (($validated['recorrencia_valor_tipo'] ?? 'fixo') === 'variavel') {
                $nextData['observacoes'] = trim((string) ($validated['observacoes'] ?? '') . "\nValor estimado. Atualize quando a conta chegar.");
            }

            if (!empty($validated['data_vencimento'])) {
                $nextData['data_vencimento'] = $nextReferenceDate->toDateString();
            }

            Finance::create($nextData);
        }
    }

    private function dashboardFinanceAlerts(int $userId, Carbon $today, float $totalReceitas, float $totalDespesas): array
    {
        $alerts = [];

        $overdueQuery = Finance::query()
            ->where('user_id', $userId)
            ->where('tipo', 'despesa')
            ->where('status', 'pendente')
            ->whereDate('data_vencimento', '<', $today->toDateString());

        $overdueCount = (clone $overdueQuery)->count();
        $overdueTotal = (float) (clone $overdueQuery)->sum('valor');

        if ($overdueCount > 0) {
            $alerts[] = [
                'type' => 'danger',
                'title' => 'Despesas vencidas',
                'message' => "{$overdueCount} lançamento(s) pendente(s) passaram do vencimento.",
                'amount' => $overdueTotal,
            ];
        }

        $todayDueQuery = Finance::query()
            ->where('user_id', $userId)
            ->where('tipo', 'despesa')
            ->where('status', 'pendente')
            ->whereDate('data_vencimento', $today->toDateString());

        $todayDueCount = (clone $todayDueQuery)->count();
        $todayDueTotal = (float) (clone $todayDueQuery)->sum('valor');

        if ($todayDueCount > 0) {
            $alerts[] = [
                'type' => 'warning',
                'title' => 'Vence hoje',
                'message' => "{$todayDueCount} despesa(s) vencem hoje.",
                'amount' => $todayDueTotal,
            ];
        }

        $nextDueQuery = Finance::query()
            ->where('user_id', $userId)
            ->where('tipo', 'despesa')
            ->where('status', 'pendente')
            ->whereBetween('data_vencimento', [
                $today->copy()->addDay()->toDateString(),
                $today->copy()->addDays(7)->toDateString(),
            ]);

        $nextDueCount = (clone $nextDueQuery)->count();
        $nextDueTotal = (float) (clone $nextDueQuery)->sum('valor');

        if ($nextDueCount > 0) {
            $alerts[] = [
                'type' => 'info',
                'title' => 'Próximos 7 dias',
                'message' => "{$nextDueCount} despesa(s) pendente(s) vencem em breve.",
                'amount' => $nextDueTotal,
            ];
        }

        if ($totalDespesas > $totalReceitas) {
            $alerts[] = [
                'type' => 'danger',
                'title' => 'Saldo mensal negativo',
                'message' => 'As despesas do mês estão maiores que as receitas.',
                'amount' => $totalDespesas - $totalReceitas,
            ];
        }

        if (empty($alerts)) {
            $alerts[] = [
                'type' => 'success',
                'title' => 'Financeiro em dia',
                'message' => 'Nenhum alerta financeiro importante para agora.',
                'amount' => null,
            ];
        }

        return $alerts;
    }

    private function dashboardWorkoutChartData(int $userId): array
    {
        $trainingDivisions = TrainingDivision::query()
            ->with(['exercises.exerciseCategory.muscleGroup', 'workout'])
            ->whereHas('workout', fn ($query) => $query->where('user_id', $userId))
            ->orderBy('nome')
            ->get();

        $exercises = Exercise::query()
            ->with(['exerciseCategory.muscleGroup', 'trainingDivision.workout'])
            ->whereHas('trainingDivision.workout', fn ($query) => $query->where('user_id', $userId))
            ->get();

        $workoutProgress = WorkoutProgress::query()
            ->where('user_id', $userId)
            ->orderBy('data_registro')
            ->get();

        $exercisesByDivision = $trainingDivisions
            ->map(fn (TrainingDivision $division) => [
                'label' => $division->nome,
                'total' => $division->exercises->count(),
            ])
            ->values();

        $volumeByMuscleGroup = $exercises
            ->groupBy(fn (Exercise $exercise) => data_get($exercise, 'exerciseCategory.muscleGroup.nome', 'Sem grupo'))
            ->map(fn ($items, $label) => [
                'label' => $label,
                'total' => $items->sum(function (Exercise $exercise) {
                    return (int) ($exercise->series ?? 0) * (int) ($exercise->repeticoes ?? 0);
                }),
            ])
            ->sortByDesc('total')
            ->values();

        $progressTimeline = $workoutProgress
            ->map(fn (WorkoutProgress $progress) => [
                'label' => Carbon::parse($progress->data_registro)->format('d/m'),
                'peso' => $progress->peso ? (float) $progress->peso : null,
                'meta_kcal' => $progress->meta_kcal ? (int) $progress->meta_kcal : null,
            ])
            ->values();

        return [
            'divisionLabels' => $exercisesByDivision->pluck('label')->values(),
            'divisionSeries' => $exercisesByDivision->pluck('total')->values(),
            'muscleLabels' => $volumeByMuscleGroup->pluck('label')->values(),
            'muscleSeries' => $volumeByMuscleGroup->pluck('total')->values(),
            'progressLabels' => $progressTimeline->pluck('label')->values(),
            'weightSeries' => $progressTimeline->pluck('peso')->values(),
            'kcalSeries' => $progressTimeline->pluck('meta_kcal')->values(),
        ];
    }
}

