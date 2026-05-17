<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutProgress extends Model
{
    protected $table = 'workout_progress';

    protected $fillable = [
        'user_id',
        'data_registro',
        'idade',
        'peso',
        'altura',
        'meta_kcal',
        'meta_necessaria',
        'carboidrato',
        'proteina',
        'gordura',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}