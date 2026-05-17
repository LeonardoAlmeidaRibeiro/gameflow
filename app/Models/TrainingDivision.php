<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingDivision extends Model
{
    protected $fillable = [
        'workout_id',
        'nome',
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function workoutRoutines()
    {
        return $this->hasMany(WorkoutRoutine::class);
    }

    public function workoutLogs()
    {
        return $this->hasMany(WorkoutLog::class);
    }
}
