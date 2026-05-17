<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'training_division_id',
        'nome',
        'series',
        'repeticoes',
        'carga',
        'tempo_descanso',
        'observacao',
    ];

    public function trainingDivision()
    {
        return $this->belongsTo(TrainingDivision::class);
    }

    public function workoutLogExercises()
    {
        return $this->hasMany(WorkoutLogExercise::class);
    }
}
