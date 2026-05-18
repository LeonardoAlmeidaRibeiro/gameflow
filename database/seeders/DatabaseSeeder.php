<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Finance;
use App\Models\FinancePaymentMethod;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'cpf' => '12345678900',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'photo' => 'assets/imagens/avatar.png',
            'phone' => '(11) 99999-0000',
        ]);

        $this->call([
            CategoriaSeeder::class,
            GrupoMuscularSeeder::class,
            ExerciseCategorySeeder::class,
            WorkoutSeeder::class,
        ]);

        $this->seedTestUserFinanceData($user);
    }

    private function seedTestUserFinanceData(User $user): void
    {
        Finance::query()
            ->where('user_id', $user->id)
            ->delete();

        FinancePaymentMethod::query()
            ->where('user_id', $user->id)
            ->delete();

        $categories = Categoria::query()
            ->get()
            ->keyBy(function (Categoria $categoria) {
                return $this->normalizeCategoryName($categoria->nome);
            });

        $paymentMethods = collect([
            [
                'tipo' => 'credito',
                'nome' => 'Nubank Gold',
                'bandeira' => 'Mastercard',
                'ultimos_digitos' => '4488',
            ],
            [
                'tipo' => 'credito',
                'nome' => 'Itaú Click',
                'bandeira' => 'Visa',
                'ultimos_digitos' => '1204',
            ],
            [
                'tipo' => 'debito',
                'nome' => 'Conta Corrente',
                'bandeira' => 'Elo',
                'ultimos_digitos' => '7781',
            ],
            [
                'tipo' => 'carteira_digital',
                'nome' => 'Carteira PicPay',
                'bandeira' => null,
                'ultimos_digitos' => null,
            ],
            [
                'tipo' => 'dinheiro',
                'nome' => 'Dinheiro',
                'bandeira' => null,
                'ultimos_digitos' => null,
            ],
        ])->mapWithKeys(function (array $data) use ($user) {
            $method = FinancePaymentMethod::create($data + [
                'user_id' => $user->id,
                'ativo' => true,
            ]);

            return [$data['nome'] => $method];
        });

        $year = now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $reference = now()->setDate($year, $month, 10)->startOfDay();
            $salary = 5200 + (($month % 4) * 180);
            $freelance = $month % 3 === 0 ? 900 : ($month % 5 === 0 ? 550 : 0);

            $this->createFinance($user, $categories, $paymentMethods, [
                'titulo' => 'Salário',
                'descricao' => 'Receita fixa mensal',
                'tipo' => 'receita',
                'categoria' => 'Receita',
                'valor' => $salary,
                'mes' => $month,
                'ano' => $year,
                'status' => $month <= now()->month ? 'pago' : 'pendente',
                'data_vencimento' => $reference->copy()->day(5),
                'data_pagamento' => $month <= now()->month ? $reference->copy()->day(5) : null,
                'payment_method' => 'Conta Corrente',
            ]);

            if ($freelance > 0) {
                $this->createFinance($user, $categories, $paymentMethods, [
                    'titulo' => 'Projeto freelancer',
                    'descricao' => 'Receita variável de serviços',
                    'tipo' => 'receita',
                    'categoria' => 'Receita',
                    'valor' => $freelance,
                    'mes' => $month,
                    'ano' => $year,
                    'status' => $month <= now()->month ? 'pago' : 'pendente',
                    'data_vencimento' => $reference->copy()->day(20),
                    'data_pagamento' => $month <= now()->month ? $reference->copy()->day(21) : null,
                    'payment_method' => 'Conta Corrente',
                ]);
            }

            $expenses = [
                ['Aluguel', 'Moradia', 1650, 6, 'Conta Corrente'],
                ['Mercado', 'Alimentação', 820 + (($month % 3) * 35), 8, 'Itaú Click'],
                ['Internet', 'Assinaturas', 119.90, 12, 'Nubank Gold'],
                ['Streaming e apps', 'Assinaturas', 89.90, 15, 'Nubank Gold'],
                ['Transporte', 'Transporte', 360 + (($month % 2) * 45), 18, 'Conta Corrente'],
                ['Academia e saúde', 'Saúde', 185, 22, 'Carteira PicPay'],
                ['Lazer', 'Lazer', 320 + (($month % 4) * 40), 25, 'Dinheiro'],
                ['Cursos e livros', 'Educação', 210, 27, 'Itaú Click'],
                ['Reserva de investimento', 'Investimentos', 650 + (($month % 2) * 100), 28, 'Conta Corrente'],
            ];

            foreach ($expenses as $expense) {
                $status = $month < now()->month ? 'pago' : ($month === now()->month ? 'pendente' : 'pendente');
                $dueDate = $reference->copy()->day($expense[3]);

                $this->createFinance($user, $categories, $paymentMethods, [
                    'titulo' => $expense[0],
                    'descricao' => 'Despesa mensal para teste',
                    'tipo' => 'despesa',
                    'categoria' => $expense[1],
                    'valor' => $expense[2],
                    'mes' => $month,
                    'ano' => $year,
                    'status' => $status,
                    'data_vencimento' => $dueDate,
                    'data_pagamento' => $status === 'pago' ? $dueDate->copy()->addDay() : null,
                    'payment_method' => $expense[4],
                ]);
            }
        }

        $currentMonth = now()->month;

        $this->createFinance($user, $categories, $paymentMethods, [
            'titulo' => 'Conta de luz vencida',
            'descricao' => 'Lançamento para testar alerta de atraso',
            'tipo' => 'despesa',
            'categoria' => 'Moradia',
            'valor' => 248.75,
            'mes' => $currentMonth,
            'ano' => $year,
            'status' => 'pendente',
            'data_vencimento' => now()->subDays(3),
            'data_pagamento' => null,
            'payment_method' => 'Conta Corrente',
        ]);

        $this->createFinance($user, $categories, $paymentMethods, [
            'titulo' => 'Seguro do cartão',
            'descricao' => 'Lançamento para testar alerta de vencimento hoje',
            'tipo' => 'despesa',
            'categoria' => 'Outros',
            'valor' => 42.90,
            'mes' => $currentMonth,
            'ano' => $year,
            'status' => 'pendente',
            'data_vencimento' => now(),
            'data_pagamento' => null,
            'payment_method' => 'Nubank Gold',
        ]);
    }

    private function createFinance(User $user, $categories, $paymentMethods, array $data): void
    {
        $category = $categories->get($this->normalizeCategoryName($data['categoria']));
        $paymentMethod = $paymentMethods->get($data['payment_method']);

        Finance::create([
            'user_id' => $user->id,
            'titulo' => $data['titulo'],
            'descricao' => $data['descricao'] ?? null,
            'tipo' => $data['tipo'],
            'categoria_id' => $category ? $category->id : null,
            'valor' => $data['valor'],
            'mes' => $data['mes'],
            'ano' => $data['ano'],
            'status' => $data['status'],
            'data_vencimento' => optional($data['data_vencimento'])->toDateString(),
            'data_pagamento' => optional($data['data_pagamento'])->toDateString(),
            'forma_pagamento' => $paymentMethod ? $paymentMethod->display_name : null,
            'payment_method_id' => $paymentMethod ? $paymentMethod->id : null,
            'recorrente' => false,
            'recorrencia_intervalo' => 1,
            'observacoes' => $data['observacoes'] ?? null,
        ]);
    }

    private function normalizeCategoryName(string $name): string
    {
        $normalized = strtr($name, [
            'á' => 'a',
            'à' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'é' => 'e',
            'ê' => 'e',
            'í' => 'i',
            'ó' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ú' => 'u',
            'ç' => 'c',
            'Á' => 'A',
            'À' => 'A',
            'Â' => 'A',
            'É' => 'E',
            'Ê' => 'E',
            'Í' => 'I',
            'Ó' => 'O',
            'Õ' => 'O',
            'Ô' => 'O',
            'Ú' => 'U',
            'Ç' => 'C',
        ]);

        return mb_strtolower($normalized);
    }
}
