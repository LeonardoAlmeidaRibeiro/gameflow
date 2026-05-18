<?php

namespace Database\Seeders;

use App\Models\ExerciseCategory;
use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class ExerciseCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Peito' => [
                ['nome' => 'Supino', 'descricao' => 'Exercícios de empurrar para peitoral.'],
                ['nome' => 'Crucifixo', 'descricao' => 'Movimentos de abertura para peitoral.'],
            ],
            'Costas' => [
                ['nome' => 'Puxada', 'descricao' => 'Exercícios de puxar na vertical.'],
                ['nome' => 'Remada', 'descricao' => 'Exercícios de puxar na horizontal.'],
            ],
            'Ombros' => [
                ['nome' => 'Desenvolvimento', 'descricao' => 'Press acima da cabeça.'],
                ['nome' => 'Elevação lateral', 'descricao' => 'Isolamento para deltoide lateral.'],
            ],
            'Biceps' => [
                ['nome' => 'Rosca direta', 'descricao' => 'Flexão de cotovelo com barra ou halteres.'],
            ],
            'Triceps' => [
                ['nome' => 'Tríceps pulley', 'descricao' => 'Extensão de cotovelo na polia.'],
            ],
            'Quadríceps' => [
                ['nome' => 'Agachamento', 'descricao' => 'Movimento base para membros inferiores.'],
                ['nome' => 'Leg press', 'descricao' => 'Empurrar plataforma com foco em pernas.'],
            ],
            'Posterior de Coxa' => [
                ['nome' => 'Mesa flexora', 'descricao' => 'Flexão de joelho para posterior de coxa.'],
            ],
            'Glúteos' => [
                ['nome' => 'Elevação pélvica', 'descricao' => 'Extensão de quadril com foco em glúteos.'],
            ],
            'Panturrilhas' => [
                ['nome' => 'Gêmeos em pé', 'descricao' => 'Flexão plantar em pé.'],
            ],
            'Abdômen' => [
                ['nome' => 'Prancha', 'descricao' => 'Estabilização do core.'],
            ],
        ];

        foreach ($categories as $groupName => $items) {
            $group = MuscleGroup::query()->where('nome', $groupName)->first();

            if (!$group) {
                continue;
            }

            foreach ($items as $item) {
                ExerciseCategory::updateOrCreate([
                    'muscle_group_id' => $group->id,
                    'nome' => $item['nome'],
                ], [
                    'descricao' => $item['descricao'],
                    'imagem' => null,
                ]);
            }
        }
    }
}
