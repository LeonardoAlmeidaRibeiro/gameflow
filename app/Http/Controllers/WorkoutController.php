<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\TrainingDivision;
use App\Models\Workout;
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
            ->with(['trainingDivisions.exercises', 'trainingDivisions.workoutRoutines'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $workoutProgress = WorkoutProgress::query()
            ->where('user_id', $user->id)
            ->latest('data_registro')
            ->get();

        $trainingDivisions = TrainingDivision::query()
            ->with(['workout', 'exercises', 'workoutRoutines'])
            ->whereHas('workout', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('nome')
            ->get();

        $exercises = Exercise::query()
            ->with('trainingDivision.workout')
            ->whereHas('trainingDivision.workout', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
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

        return view('workout.index', [
            'user' => $user,
            'workouts' => $workouts,
            'workoutProgress' => $workoutProgress,
            'trainingDivisions' => $trainingDivisions,
            'exercises' => $exercises,
            'workoutRoutines' => $workoutRoutines,
            'latestProgress' => $workoutProgress->first(),
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

    private function workoutRules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'objetivo' => ['nullable', 'string', 'max:255'],
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
