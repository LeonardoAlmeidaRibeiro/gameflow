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
                ['nome' => 'Supino', 'descricao' => 'Exercícios de empurrar para peitoral.','imagem' => 'images/supino-reto.gif'],
                ['nome' => 'Crucifixo', 'descricao' => 'Movimentos de abertura para peitoral.','imagem' => 'images/crucifixo.gif'],
            ],
            'Costas' => [
                ['nome' => 'Puxada', 'descricao' => 'Exercícios de puxar na vertical.','imagem' => 'images/puxada.gif'],
                ['nome' => 'Remada', 'descricao' => 'Exercícios de puxar na horizontal.','imagem' => 'images/remada.gif'],
            ],
            'Ombros' => [
                ['nome' => 'Desenvolvimento', 'descricao' => 'Press acima da cabeça.','imagem' => 'images/desenvolvimento.gif'],
                ['nome' => 'Elevação lateral', 'descricao' => 'Isolamento para deltoide lateral.','imagem' => 'images/elevacao-lateral.gif'],
            ],
            'Biceps' => [
                ['nome' => 'Rosca direta', 'descricao' => 'Flexão de cotovelo com barra ou halteres.','imagem' => 'images/rosca-direta.gif'],
            ],
            'Triceps' => [
                ['nome' => 'Tríceps pulley', 'descricao' => 'Extensão de cotovelo na polia.','imagem' => 'images/triceps-pulley.gif'],
            ],
            'Quadríceps' => [
                ['nome' => 'Agachamento', 'descricao' => 'Movimento base para membros inferiores.','imagem' => 'images/agachamento.gif'],
                ['nome' => 'Leg press', 'descricao' => 'Empurrar plataforma com foco em pernas.','imagem' => 'images/leg-press.gif'],
            ],
            'Posterior de Coxa' => [
                ['nome' => 'Mesa flexora', 'descricao' => 'Flexão de joelho para posterior de coxa.','imagem' => 'images/mesa-flexora.gif'],
            ],
            'Glúteos' => [
                ['nome' => 'Elevação pélvica', 'descricao' => 'Extensão de quadril com foco em glúteos.','imagem' => 'images/elevacao-pelvica.gif'],
            ],
            'Panturrilhas' => [
                ['nome' => 'Gêmeos em pé', 'descricao' => 'Flexão plantar em pé.','imagem' => 'images/gemeos-em-pe.gif'],
            ],
            'Abdômen' => [
                ['nome' => 'Prancha', 'descricao' => 'Estabilização do core.','imagem' => 'images/prancha.gif'],
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
                    'imagem' => $item['imagem'],
                ]);
            }
        }
    }
}
