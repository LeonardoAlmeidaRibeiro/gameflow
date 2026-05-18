<?php

namespace Database\Seeders;

use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class GrupoMuscularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupo_muscalares = [
            ['nome' => 'Abdômen',],
            ['nome' => 'Glúteos',],
            ['nome' => 'Ombros',],
            ['nome' => 'Panturrilhas',],
            ['nome' => 'Posterior de Coxa'],
            ['nome' => 'Quadríceps'],
            ['nome' => 'Costas',],
            ['nome' => 'Peito',],
            ['nome' => 'Biceps',],
            ['nome' => 'Triceps',]



        ];

        foreach ($grupo_muscalares as $grupo) {
            MuscleGroup::updateOrCreate(
                ['nome' => $grupo['nome']],
            );
        }
    }
}
