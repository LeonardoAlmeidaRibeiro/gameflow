<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseCategory extends Model
{
    protected $fillable = [
        'muscle_group_id',
        'nome',
        'descricao',
        'imagem',
    ];

    public function muscleGroup()
    {
        return $this->belongsTo(MuscleGroup::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}
