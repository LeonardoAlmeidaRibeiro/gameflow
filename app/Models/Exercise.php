<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'training_division_id',
        'exercise_category_id',
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

    public function exerciseCategory()
    {
        return $this->belongsTo(ExerciseCategory::class);
    }

    public function workoutLogExercises()
    {
        return $this->hasMany(WorkoutLogExercise::class);
    }
}
