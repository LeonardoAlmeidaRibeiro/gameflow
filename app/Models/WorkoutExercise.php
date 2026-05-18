<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    protected $table = 'exercise_categories';

    protected $fillable = [
        'muscle_group_id',
        'nome',
        'descricao',
        'imagem',
    ];

    public function category()
    {
        return $this->belongsTo(
            MuscleGroup::class,
            'muscle_group_id'
        );
    }
}
