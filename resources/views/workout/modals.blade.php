@php
    $workoutActionTemplate = route('workouts.update', ['workout' => '__ID__']);
    $progressActionTemplate = route('workouts.progress.update', ['progress' => '__ID__']);
    $divisionActionTemplate = route('workouts.divisions.update', ['division' => '__ID__']);
    $exerciseActionTemplate = route('workouts.exercises.update', ['exercise' => '__ID__']);
    $routineActionTemplate = route('workouts.routines.update', ['routine' => '__ID__']);
@endphp

<div class="modal fade" id="modal_adicionar_workout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content js-workout-form" method="POST" action="{{ route('workouts.store') }}">
            @csrf
            <div class="modal-header">
                <h2 class="fw-bold">Adicionar treino</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                <label class="form-label required">Nome</label>
                <input type="text" name="nome" class="form-control mb-5" data-label="Nome">
                <label class="form-label">Objetivo</label>
                <input type="text" name="objetivo" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_editar_workout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="form_editar_workout" class="modal-content js-workout-form" method="POST" data-action-template="{{ $workoutActionTemplate }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h2 class="fw-bold">Editar treino</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                <label class="form-label required">Nome</label>
                <input type="text" name="nome" class="form-control mb-5" data-label="Nome">
                <label class="form-label">Objetivo</label>
                <input type="text" name="objetivo" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_adicionar_division" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content js-workout-form" method="POST" action="{{ route('workouts.divisions.store') }}">
            @csrf
            <div class="modal-header">
                <h2 class="fw-bold">Adicionar divisão</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                <label class="form-label required">Treino</label>
                <select name="workout_id" class="form-select mb-5" data-label="Treino">
                    <option value="">Selecione</option>
                    @foreach ($workouts as $workout)
                        <option value="{{ $workout->id }}">{{ $workout->nome }}</option>
                    @endforeach
                </select>
                <label class="form-label required">Nome</label>
                <input type="text" name="nome" class="form-control" data-label="Nome">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_editar_division" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="form_editar_division" class="modal-content js-workout-form" method="POST" data-action-template="{{ $divisionActionTemplate }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h2 class="fw-bold">Editar divisão</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                <label class="form-label required">Treino</label>
                <select name="workout_id" class="form-select mb-5" data-label="Treino">
                    <option value="">Selecione</option>
                    @foreach ($workouts as $workout)
                        <option value="{{ $workout->id }}">{{ $workout->nome }}</option>
                    @endforeach
                </select>
                <label class="form-label required">Nome</label>
                <input type="text" name="nome" class="form-control" data-label="Nome">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_adicionar_exercise" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content js-workout-form" method="POST" action="{{ route('workouts.exercises.store') }}">
            @csrf
            <div class="modal-header">
                <h2 class="fw-bold">Adicionar exercício</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                @include('workout.partials.exercise-fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_editar_exercise" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="form_editar_exercise" class="modal-content js-workout-form" method="POST" data-action-template="{{ $exerciseActionTemplate }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h2 class="fw-bold">Editar exercício</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                @include('workout.partials.exercise-fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_adicionar_routine" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content js-workout-form" method="POST" action="{{ route('workouts.routines.store') }}">
            @csrf
            <div class="modal-header">
                <h2 class="fw-bold">Adicionar rotina</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                @include('workout.partials.routine-fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_editar_routine" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="form_editar_routine" class="modal-content js-workout-form" method="POST" data-action-template="{{ $routineActionTemplate }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h2 class="fw-bold">Editar rotina</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                @include('workout.partials.routine-fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_adicionar_progress" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="modal-content js-workout-form" method="POST" action="{{ route('workouts.progress.store') }}">
            @csrf
            <div class="modal-header">
                <h2 class="fw-bold">Adicionar progresso</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                @include('workout.partials.progress-fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_editar_progress" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="form_editar_progress" class="modal-content js-workout-form" method="POST" data-action-template="{{ $progressActionTemplate }}">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h2 class="fw-bold">Editar progresso</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">x</button>
            </div>
            <div class="modal-body">
                @include('workout.partials.progress-fields')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
