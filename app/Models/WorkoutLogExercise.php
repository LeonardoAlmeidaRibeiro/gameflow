<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutLogExercise extends Model
{
    protected $fillable = [
        'workout_log_id',
        'exercise_id',
        'nome_exercicio',
        'series',
        'repeticoes',
        'carga',
        'observacao',
    ];

    protected $casts = [
        'carga' => 'decimal:2',
    ];

    public function workoutLog()
    {
        return $this->belongsTo(WorkoutLog::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}