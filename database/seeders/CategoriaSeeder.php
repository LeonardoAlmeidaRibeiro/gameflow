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
            'Alimentação',
            'Assinaturas',
            'Educação',
            'Investimentos',
            'Lazer',
            'Moradia',
            'Receita',
            'Saúde',
            'Transporte',
            'Outros',
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(['nome' => $categoria]);
        }
    }
}
