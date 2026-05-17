<div class="row g-5">
    <div class="col-md-6">
        <label class="form-label required">Divisão</label>
        <select name="training_division_id" class="form-select" data-label="Divisão">
            <option value="">Selecione</option>
            @foreach ($trainingDivisions as $division)
                <option value="{{ $division->id }}">{{ data_get($division, 'workout.nome') }} - {{ $division->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label required">Nome</label>
        <input type="text" name="nome" class="form-control" data-label="Nome">
    </div>
    <div class="col-md-3">
        <label class="form-label">Séries</label>
        <input type="number" name="series" class="form-control" min="1">
    </div>
    <div class="col-md-3">
        <label class="form-label">Repetições</label>
        <input type="number" name="repeticoes" class="form-control" min="1">
    </div>
    <div class="col-md-3">
        <label class="form-label">Carga</label>
        <input type="number" name="carga" class="form-control" min="0" step="0.01">
    </div>
    <div class="col-md-3">
        <label class="form-label">Descanso</label>
        <input type="number" name="tempo_descanso" class="form-control" min="0">
    </div>
    <div class="col-12">
        <label class="form-label">Observação</label>
        <textarea name="observacao" class="form-control" rows="3"></textarea>
    </div>
</div>
