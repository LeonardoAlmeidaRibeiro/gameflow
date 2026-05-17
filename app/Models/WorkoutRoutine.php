<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutRoutine extends Model
{
    protected $fillable = [
        'user_id',
        'training_division_id',
        'dia_semana',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingDivision()
    {
        return $this->belongsTo(TrainingDivision::class);
    }
}