<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Alimentação', 'icone' => '🍽️'],
            ['nome' => 'Assinaturas', 'icone' => '🔁'],
            ['nome' => 'Educação', 'icone' => '📚'],
            ['nome' => 'Investimentos', 'icone' => '📈'],
            ['nome' => 'Lazer', 'icone' => '🎮'],
            ['nome' => 'Moradia', 'icone' => '🏠'],
            ['nome' => 'Receita', 'icone' => '💰'],
            ['nome' => 'Saúde', 'icone' => '🩺'],
            ['nome' => 'Transporte', 'icone' => '🚗'],
            ['nome' => 'Outros', 'icone' => '📦'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nome' => $categoria['nome']],
                ['icone' => $categoria['icone']]
            );
        }
    }
}
