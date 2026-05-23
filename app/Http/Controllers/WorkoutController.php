<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseCategory;
use App\Models\TrainingDivision;
use App\Models\Workout;
use App\Models\WorkoutLog;
use App\Models\WorkoutLogExercise;
use App\Models\WorkoutProgress;
use App\Models\WorkoutRoutine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $workouts = Workout::query()
            ->with(['trainingDivisions.exercises.exerciseCategory.muscleGroup', 'trainingDivisions.workoutRoutines'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $allWorkoutProgress = WorkoutProgress::query()
            ->where('user_id', $user->id)
            ->latest('data_registro')
            ->get();

        $workoutProgress = WorkoutProgress::query()
            ->where('user_id', $user->id)
            ->latest('data_registro')
            ->paginate(5, ['*'], 'progress_page')
            ->withQueryString();

        $trainingDivisions = TrainingDivision::query()
            ->with(['workout', 'exercises.exerciseCategory.muscleGroup', 'workoutRoutines'])
            ->whereHas('workout', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('nome')
            ->get();

        $exercises = Exercise::query()
            ->with(['trainingDivision.workout', 'exerciseCategory.muscleGroup'])
            ->whereHas('trainingDivision.workout', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('nome')
            ->get();

        $exerciseCategories = ExerciseCategory::query()
            ->with('muscleGroup')
            ->orderBy('nome')
            ->get();

        $workoutRoutines = WorkoutRoutine::query()
            ->with('trainingDivision.workout')
            ->where('user_id', $user->id)
            ->get()
            ->sortBy(function (WorkoutRoutine $routine) {
                $days = [
                    'segunda' => 1,
                    'segunda-feira' => 1,
                    'terca' => 2,
                    'terça' => 2,
                    'terca-feira' => 2,
                    'terça-feira' => 2,
                    'quarta' => 3,
                    'quarta-feira' => 3,
                    'quinta' => 4,
                    'quinta-feira' => 4,
                    'sexta' => 5,
                    'sexta-feira' => 5,
                    'sabado' => 6,
                    'sábado' => 6,
                    'domingo' => 7,
                ];

                return $days[mb_strtolower($routine->dia_semana)] ?? 99;
            })
            ->values();

        $workoutLogs = WorkoutLog::query()
            ->with(['trainingDivision.workout', 'exercises'])
            ->where('user_id', $user->id)
            ->latest('data_treino')
            ->latest()
            ->take(10)
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

        $progressTimeline = $allWorkoutProgress
            ->take(5)
            ->sortBy('data_registro')
            ->map(fn (WorkoutProgress $progress) => [
                'label' => \Carbon\Carbon::parse($progress->data_registro)->format('d/m'),
                'peso' => $progress->peso ? (float) $progress->peso : null,
                'meta_kcal' => $progress->meta_kcal ? (int) $progress->meta_kcal : null,
            ])
            ->values();

        return view('workout.index', [
            'user' => $user,
            'workouts' => $workouts,
            'workoutProgress' => $workoutProgress,
            'trainingDivisions' => $trainingDivisions,
            'exercises' => $exercises,
            'exerciseCategories' => $exerciseCategories,
            'workoutRoutines' => $workoutRoutines,
            'workoutLogs' => $workoutLogs,
            'latestProgress' => $allWorkoutProgress->first(),
            'workoutChartData' => [
                'divisionLabels' => $exercisesByDivision->pluck('label'),
                'divisionSeries' => $exercisesByDivision->pluck('total'),
                'muscleLabels' => $volumeByMuscleGroup->pluck('label'),
                'muscleSeries' => $volumeByMuscleGroup->pluck('total'),
                'progressLabels' => $progressTimeline->pluck('label'),
                'weightSeries' => $progressTimeline->pluck('peso'),
                'kcalSeries' => $progressTimeline->pluck('meta_kcal'),
            ],
        ]);
    }

    public function storeWorkout(Request $request)
    {
        $validator = Validator::make($request->all(), $this->workoutRules(), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_adicionar_workout');
        }

        Workout::create($validator->validated() + [
            'user_id' => $request->user()->id,
        ]);

        return back()->with('status', 'Treino cadastrado com sucesso.');
    }

    public function updateWorkout(Request $request, Workout $workout)
    {
        $this->authorizeWorkout($request, $workout);

        $validator = Validator::make($request->all(), $this->workoutRules(), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_editar_workout');
        }

        $workout->update($validator->validated());

        return back()->with('status', 'Treino atualizado com sucesso.');
    }

    public function destroyWorkout(Request $request, Workout $workout)
    {
        $this->authorizeWorkout($request, $workout);

        $workout->delete();

        return back()->with('status', 'Treino excluído com sucesso.');
    }

    public function storeProgress(Request $request)
    {
        $validator = Validator::make($request->all(), $this->progressRules(), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_adicionar_progress');
        }

        WorkoutProgress::create($validator->validated() + [
            'user_id' => $request->user()->id,
        ]);

        return back()->with('status', 'Progresso cadastrado com sucesso.');
    }

    public function updateProgress(Request $request, WorkoutProgress $progress)
    {
        abort_if($progress->user_id !== $request->user()->id, 404);

        $validator = Validator::make($request->all(), $this->progressRules(), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_editar_progress');
        }

        $progress->update($validator->validated());

        return back()->with('status', 'Progresso atualizado com sucesso.');
    }

    public function destroyProgress(Request $request, WorkoutProgress $progress)
    {
        abort_if($progress->user_id !== $request->user()->id, 404);

        $progress->delete();

        return back()->with('status', 'Progresso excluído com sucesso.');
    }

    public function storeDivision(Request $request)
    {
        $validator = Validator::make($request->all(), $this->divisionRules($request), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_adicionar_division');
        }

        TrainingDivision::create($validator->validated());

        return back()->with('status', 'Divisão cadastrada com sucesso.');
    }

    public function updateDivision(Request $request, TrainingDivision $division)
    {
        $this->authorizeDivision($request, $division);

        $validator = Validator::make($request->all(), $this->divisionRules($request), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_editar_division');
        }

        $division->update($validator->validated());

        return back()->with('status', 'Divisão atualizada com sucesso.');
    }

    public function destroyDivision(Request $request, TrainingDivision $division)
    {
        $this->authorizeDivision($request, $division);

        $division->delete();

        return back()->with('status', 'Divisão excluída com sucesso.');
    }

    public function storeExercise(Request $request)
    {
        $validator = Validator::make($request->all(), $this->exerciseRules($request), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_adicionar_exercise');
        }

        Exercise::create($validator->validated());

        return back()->with('status', 'Exercício cadastrado com sucesso.');
    }

    public function updateExercise(Request $request, Exercise $exercise)
    {
        $this->authorizeExercise($request, $exercise);

        $validator = Validator::make($request->all(), $this->exerciseRules($request), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_editar_exercise');
        }

        $exercise->update($validator->validated());

        return back()->with('status', 'Exercício atualizado com sucesso.');
    }

    public function destroyExercise(Request $request, Exercise $exercise)
    {
        $this->authorizeExercise($request, $exercise);

        $exercise->delete();

        return back()->with('status', 'Exercício excluído com sucesso.');
    }

    public function storeRoutine(Request $request)
    {
        $validator = Validator::make($request->all(), $this->routineRules($request), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_adicionar_routine');
        }

        WorkoutRoutine::create($validator->validated() + [
            'user_id' => $request->user()->id,
        ]);

        return back()->with('status', 'Rotina cadastrada com sucesso.');
    }

    public function updateRoutine(Request $request, WorkoutRoutine $routine)
    {
        abort_if($routine->user_id !== $request->user()->id, 404);

        $validator = Validator::make($request->all(), $this->routineRules($request), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_editar_routine');
        }

        $routine->update($validator->validated());

        return back()->with('status', 'Rotina atualizada com sucesso.');
    }

    public function destroyRoutine(Request $request, WorkoutRoutine $routine)
    {
        abort_if($routine->user_id !== $request->user()->id, 404);

        $routine->delete();

        return back()->with('status', 'Rotina excluída com sucesso.');
    }

    public function storeCheckin(Request $request)
    {
        $validator = Validator::make($request->all(), $this->checkinRules($request), $this->messages());

        if ($validator->fails()) {
            return $this->backWithWorkoutErrors($validator, 'modal_registrar_treino');
        }

        $validated = $validator->validated();
        $division = TrainingDivision::query()
            ->with(['workout', 'exercises'])
            ->findOrFail($validated['training_division_id']);

        $this->authorizeDivision($request, $division);

        $log = WorkoutLog::create([
            'user_id' => $request->user()->id,
            'training_division_id' => $division->id,
            'data_treino' => $validated['data_treino'],
            'nome_treino' => data_get($division, 'workout.nome') . ' - ' . $division->nome,
            'dia_semana' => $validated['dia_semana'] ?? null,
            'sensacao_esforco' => $validated['sensacao_esforco'] ?? null,
            'observacao' => $validated['observacao'] ?? null,
        ]);

        foreach ($division->exercises as $exercise) {
            WorkoutLogExercise::create([
                'workout_log_id' => $log->id,
                'exercise_id' => $exercise->id,
                'nome_exercicio' => $exercise->nome,
                'series' => $validated['series'] ?? $exercise->series,
                'repeticoes' => $validated['repeticoes'] ?? $exercise->repeticoes,
                'carga' => $validated['carga'] ?? $exercise->carga,
                'observacao' => $validated['observacao'] ?? null,
            ]);
        }

        return back()->with('status', 'Treino de hoje registrado com sucesso.');
    }

    private function workoutRules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'objetivo' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:ativo,pausado,finalizado'],
        ];
    }

    private function progressRules(): array
    {
        return [
            'data_registro' => ['required', 'date'],
            'idade' => ['nullable', 'integer', 'min:1', 'max:130'],
            'peso' => ['nullable', 'numeric', 'min:1', 'max:999.99'],
            'altura' => ['nullable', 'numeric', 'min:0.5', 'max:3'],
            'meta_kcal' => ['nullable', 'integer', 'min:1'],
            'meta_necessaria' => ['nullable', 'integer', 'min:1'],
            'carboidrato' => ['nullable', 'numeric', 'min:0'],
            'proteina' => ['nullable', 'numeric', 'min:0'],
            'gordura' => ['nullable', 'numeric', 'min:0'],
        ];
    }

    private function divisionRules(Request $request): array
    {
        return [
            'workout_id' => [
                'required',
                Rule::exists('workouts', 'id')->where(fn ($query) => $query->where('user_id', $request->user()->id)),
            ],
            'nome' => ['required', 'string', 'max:255'],
        ];
    }

    private function exerciseRules(Request $request): array
    {
        $userWorkoutIds = Workout::query()
            ->where('user_id', $request->user()->id)
            ->pluck('id');

        return [
            'training_division_id' => [
                'required',
                Rule::exists('training_divisions', 'id')->where(function ($query) use ($userWorkoutIds) {
                    $query->whereIn('workout_id', $userWorkoutIds);
                }),
            ],
            'exercise_category_id' => ['nullable', 'exists:exercise_categories,id'],
            'nome' => ['required', 'string', 'max:255'],
            'series' => ['nullable', 'integer', 'min:1'],
            'repeticoes' => ['nullable', 'integer', 'min:1'],
            'carga' => ['nullable', 'numeric', 'min:0'],
            'tempo_descanso' => ['nullable', 'integer', 'min:0'],
            'observacao' => ['nullable', 'string'],
        ];
    }

    private function routineRules(Request $request): array
    {
        $userWorkoutIds = Workout::query()
            ->where('user_id', $request->user()->id)
            ->pluck('id');

        return [
            'training_division_id' => [
                'required',
                Rule::exists('training_divisions', 'id')->where(function ($query) use ($userWorkoutIds) {
                    $query->whereIn('workout_id', $userWorkoutIds);
                }),
            ],
            'dia_semana' => ['required', 'string', 'max:50'],
        ];
    }

    private function checkinRules(Request $request): array
    {
        $userWorkoutIds = Workout::query()
            ->where('user_id', $request->user()->id)
            ->pluck('id');

        return [
            'training_division_id' => [
                'required',
                Rule::exists('training_divisions', 'id')->where(function ($query) use ($userWorkoutIds) {
                    $query->whereIn('workout_id', $userWorkoutIds);
                }),
            ],
            'data_treino' => ['required', 'date'],
            'dia_semana' => ['nullable', 'string', 'max:50'],
            'series' => ['nullable', 'integer', 'min:1'],
            'repeticoes' => ['nullable', 'integer', 'min:1'],
            'carga' => ['nullable', 'numeric', 'min:0'],
            'sensacao_esforco' => ['nullable', 'integer', 'between:1,10'],
            'observacao' => ['nullable', 'string'],
        ];
    }

    private function messages(): array
    {
        return [
            'required' => 'Preencha o campo :attribute.',
            'exists' => 'Selecione uma opção válida para :attribute.',
            'date' => 'Informe uma data válida em :attribute.',
            'integer' => 'Informe um número inteiro em :attribute.',
            'numeric' => 'Informe um número válido em :attribute.',
            'min' => 'O campo :attribute está abaixo do mínimo permitido.',
            'max' => 'O campo :attribute ultrapassou o limite permitido.',
        ];
    }

    private function backWithWorkoutErrors($validator, string $modal)
    {
        return back()
            ->withErrors($validator, 'workout')
            ->withInput()
            ->with('workout_modal', $modal);
    }

    private function authorizeWorkout(Request $request, Workout $workout): void
    {
        abort_if($workout->user_id !== $request->user()->id, 404);
    }

    private function authorizeDivision(Request $request, TrainingDivision $division): void
    {
        $division->loadMissing('workout');

        abort_if(data_get($division, 'workout.user_id') !== $request->user()->id, 404);
    }

    private function authorizeExercise(Request $request, Exercise $exercise): void
    {
        $exercise->loadMissing('trainingDivision.workout');

        abort_if(data_get($exercise, 'trainingDivision.workout.user_id') !== $request->user()->id, 404);
    }
}
