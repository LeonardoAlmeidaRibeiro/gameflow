<label class="form-label required">Divisão</label>
<select name="training_division_id" class="form-select mb-5" data-label="Divisão">
    <option value="">Selecione</option>
    @foreach ($trainingDivisions as $division)
        <option value="{{ $division->id }}">{{ data_get($division, 'workout.nome') }} - {{ $division->nome }}</option>
    @endforeach
</select>

<label class="form-label required">Dia da semana</label>
<select name="dia_semana" class="form-select" data-label="Dia da semana">
    <option value="">Selecione</option>
    @foreach ($weekDays as $day)
        <option value="{{ $day }}">{{ $day }}</option>
    @endforeach
</select>
