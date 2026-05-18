<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'objetivo',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingDivisions()
    {
        return $this->hasMany(TrainingDivision::class);
    }

    public function workoutLogs()
    {
        return $this->hasManyThrough(WorkoutLog::class, TrainingDivision::class);
    }
}
