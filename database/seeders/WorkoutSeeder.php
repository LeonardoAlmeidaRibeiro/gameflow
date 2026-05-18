<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\ExerciseCategory;
use App\Models\TrainingDivision;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutLog;
use App\Models\WorkoutLogExercise;
use App\Models\WorkoutProgress;
use App\Models\WorkoutRoutine;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->where('email', 'test@example.com')->first();

        if (!$user) {
            return;
        }

        WorkoutLog::query()->where('user_id', $user->id)->delete();
        Workout::query()->where('user_id', $user->id)->delete();
        WorkoutRoutine::query()->where('user_id', $user->id)->delete();
        WorkoutProgress::query()->where('user_id', $user->id)->delete();

        $categories = ExerciseCategory::query()
            ->get()
            ->keyBy(fn (ExerciseCategory $category) => $this->normalize($category->nome));

        $workout = Workout::create([
            'user_id' => $user->id,
            'nome' => 'Treino Hipertrofia ABC',
            'objetivo' => 'Ganho de massa muscular com rotina semanal equilibrada',
            'status' => 'ativo',
        ]);

        $divisions = [
            'A - Peito, ombros e tríceps' => [
                ['Supino reto', 'Supino', 4, 10, 55, 90, 'Manter escápulas firmes no banco.'],
                ['Crucifixo inclinado', 'Crucifixo', 3, 12, 16, 60, 'Movimento controlado, sem perder amplitude.'],
                ['Desenvolvimento com halteres', 'Desenvolvimento', 4, 10, 18, 90, 'Evitar arquear a lombar.'],
                ['Elevação lateral', 'Elevação lateral', 3, 15, 8, 45, 'Subir até a linha dos ombros.'],
                ['Tríceps pulley', 'Tríceps pulley', 4, 12, 35, 60, 'Cotovelo parado durante a extensão.'],
            ],
            'B - Costas e bíceps' => [
                ['Puxada frente', 'Puxada', 4, 10, 50, 90, 'Puxar até a altura do peito.'],
                ['Remada baixa', 'Remada', 4, 12, 45, 75, 'Fechar escápulas no final do movimento.'],
                ['Remada unilateral', 'Remada', 3, 12, 24, 60, 'Executar sem girar o tronco.'],
                ['Rosca direta', 'Rosca direta', 4, 10, 25, 60, 'Controlar a descida.'],
                ['Rosca alternada', 'Rosca direta', 3, 12, 12, 45, 'Não balançar o corpo.'],
            ],
            'C - Pernas e abdômen' => [
                ['Agachamento livre', 'Agachamento', 4, 8, 70, 120, 'Priorizar técnica antes de aumentar carga.'],
                ['Leg press 45', 'Leg press', 4, 12, 160, 90, 'Não travar completamente os joelhos.'],
                ['Mesa flexora', 'Mesa flexora', 3, 12, 35, 60, 'Segurar um segundo contraindo.'],
                ['Elevação pélvica', 'Elevação pélvica', 4, 10, 80, 90, 'Pausar no topo do movimento.'],
                ['Gêmeos em pé', 'Gêmeos em pé', 4, 15, 45, 45, 'Amplitude máxima.'],
                ['Prancha frontal', 'Prancha', 3, 45, null, 45, 'Tempo em segundos no campo repetições.'],
            ],
        ];

        $divisionModels = [];

        foreach ($divisions as $divisionName => $exercises) {
            $division = TrainingDivision::create([
                'workout_id' => $workout->id,
                'nome' => $divisionName,
            ]);

            $divisionModels[$divisionName] = $division;

            foreach ($exercises as $exercise) {
                Exercise::create([
                    'training_division_id' => $division->id,
                    'exercise_category_id' => optional($categories->get($this->normalize($exercise[1])))->id,
                    'nome' => $exercise[0],
                    'series' => $exercise[2],
                    'repeticoes' => $exercise[3],
                    'carga' => $exercise[4],
                    'tempo_descanso' => $exercise[5],
                    'observacao' => $exercise[6],
                ]);
            }
        }

        $routine = [
            'Segunda-feira' => 'A - Peito, ombros e tríceps',
            'Terça-feira' => 'B - Costas e bíceps',
            'Quarta-feira' => 'C - Pernas e abdômen',
            'Quinta-feira' => 'A - Peito, ombros e tríceps',
            'Sexta-feira' => 'B - Costas e bíceps',
            'Sábado' => 'C - Pernas e abdômen',
        ];

        foreach ($routine as $day => $divisionName) {
            WorkoutRoutine::create([
                'user_id' => $user->id,
                'training_division_id' => $divisionModels[$divisionName]->id,
                'dia_semana' => $day,
            ]);
        }

        $checkins = [
            ['Segunda-feira', 'A - Peito, ombros e trÃ­ceps', 7, 'Treino firme, boa estabilidade no supino.'],
            ['TerÃ§a-feira', 'B - Costas e bÃ­ceps', 8, 'Puxada pesada, manter controle na remada.'],
            ['Quarta-feira', 'C - Pernas e abdÃ´men', 9, 'Agachamento exigiu bastante, reduzir um pouco se cansar.'],
            ['Quinta-feira', 'A - Peito, ombros e trÃ­ceps', 6, 'Volume bom e sem dor no ombro.'],
            ['Sexta-feira', 'B - Costas e bÃ­ceps', 7, 'Boa conexÃ£o nas costas, bÃ­ceps cansou no final.'],
            ['SÃ¡bado', 'C - Pernas e abdÃ´men', 8, 'Pernas completas, panturrilha respondeu bem.'],
        ];

        foreach ($checkins as $index => $checkin) {
            $division = $divisionModels[$checkin[1]] ?? null;

            if (!$division) {
                $divisionCode = substr((string) $checkin[1], 0, 1);
                $division = collect($divisionModels)->first(function (TrainingDivision $division) use ($divisionCode) {
                    return substr((string) $division->nome, 0, 1) === $divisionCode;
                });
            }

            if (!$division) {
                continue;
            }
            $log = WorkoutLog::create([
                'user_id' => $user->id,
                'training_division_id' => $division->id,
                'data_treino' => now()->subDays(6 - $index)->toDateString(),
                'nome_treino' => $workout->nome . ' - ' . $division->nome,
                'dia_semana' => $checkin[0],
                'sensacao_esforco' => $checkin[2],
                'observacao' => $checkin[3],
            ]);

            foreach ($division->exercises()->take(3)->get() as $exercise) {
                WorkoutLogExercise::create([
                    'workout_log_id' => $log->id,
                    'exercise_id' => $exercise->id,
                    'nome_exercicio' => $exercise->nome,
                    'series' => $exercise->series,
                    'repeticoes' => $exercise->repeticoes,
                    'carga' => $exercise->carga,
                    'observacao' => $exercise->observacao,
                ]);
            }
        }

        foreach (range(0, 11) as $index) {
            WorkoutProgress::create([
                'user_id' => $user->id,
                'data_registro' => now()->subWeeks(11 - $index)->toDateString(),
                'idade' => 29,
                'peso' => 84.2 - ($index * 0.28),
                'altura' => 1.78,
                'meta_kcal' => 2600 + (($index % 3) * 80),
                'meta_necessaria' => 2350 + (($index % 4) * 45),
                'carboidrato' => 320 - ($index * 4),
                'proteina' => 160 + min($index, 8),
                'gordura' => 82 - min($index, 10),
            ]);
        }
    }

    private function normalize(string $value): string
    {
        $value = strtr($value, [
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
            'Ã' => 'A',
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

        return mb_strtolower($value);
    }
}
