<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $month = (int) $request->input('mes', now()->month);
        $year = (int) $request->input('ano', now()->year);

        $financeQuery = Finance::query()
            ->with('categoria')
            ->where('user_id', $user->id)
            ->where('mes', $month)
            ->where('ano', $year);

        $financeCategories = Categoria::query()
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
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatedFinanceData($request);
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
}

