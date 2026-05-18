<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkoutExerciseValidator extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'muscle_group_id' => 'required|exists:muscle_groups,id',
            'nome' => 'required|string|min:3|max:200|unique:exercise_categories,nome',
            'descricao' => 'nullable|string|max:200',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
        ];
    }

    public function messages()
    {
        return [
            'muscle_group_id.required' => 'Selecione o grupo muscular.',
            'muscle_group_id.exists' => 'Selecione um grupo muscular válido.',
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'Esta categoria de exercício já está sendo utilizada.',
            'descricao.max' => 'A descrição não pode ter mais de 200 caracteres.',
            'imagem.max' => 'A imagem não pode ser maior que 100MB.',
            'imagem.mimes' => 'A imagem deve ser um arquivo do tipo: jpeg, png, jpg, gif ou webp.',
        ];
    }
}
