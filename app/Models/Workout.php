<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'user_id',
        'nome',
        'objetivo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainingDivisions()
    {
        return $this->hasMany(TrainingDivision::class);
    }
}