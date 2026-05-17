<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutLog extends Model
{
    protected $fillable = [
        'user_id',
        'training_division_id',
        'data_treino',
        'nome_treino',
        'dia_semana',
        'observacao',
    ];

    protected $casts = [
        'data_treino' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingDivision()
    {
        return $this->belongsTo(TrainingDivision::class);
    }

    public function exercises()
    {
        return $this->hasMany(WorkoutLogExercise::class);
    }
}