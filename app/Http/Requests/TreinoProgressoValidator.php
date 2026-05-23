<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreinoProgressoValidator extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'data_registro' => 'required|date',
            'idade' => 'nullable|integer|min:0|max:150',
            'peso' => 'nullable|numeric|min:0|max:999.99',
            'altura' => 'nullable|numeric|min:0|max:300',
            'meta_kcal' => 'nullable|integer|min:0',
            'meta_necessaria' => 'nullable|integer|min:0',
            'carboidrato' => 'nullable|numeric|min:0|max:9999.99',
            'proteina' => 'nullable|numeric|min:0|max:9999.99',
            'gordura' => 'nullable|numeric|min:0|max:9999.99',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'O usuário é obrigatório.',
            'user_id.exists' => 'Usuário não encontrado.',
            'data_registro.required' => 'A data de registro é obrigatória.',
            'data_registro.date' => 'Formato de data inválido.',
            'idade.integer' => 'Idade deve ser um número inteiro.',
            'idade.min' => 'Idade não pode ser negativa.',
            'idade.max' => 'Idade não pode ser maior que 150 anos.',
            'peso.numeric' => 'Peso deve ser um número.',
            'peso.min' => 'Peso não pode ser negativo.',
            'altura.numeric' => 'Altura deve ser um número.',
            'altura.min' => 'Altura não pode ser negativa.',
            'altura.max' => 'Altura não pode ser maior que 300 centímetros.',
            'meta_kcal.integer' => 'Meta de calorias deve ser um número inteiro.',
            'meta_kcal.min' => 'Meta de calorias não pode ser negativa.',
            'meta_necessaria.integer' => 'Meta necessária deve ser um número inteiro.',
            'meta_necessaria.min' => 'Meta necessária não pode ser negativa.',
            'carboidrato.numeric' => 'Carboidrato deve ser um número.',
            'carboidrato.min' => 'Carboidrato não pode ser negativo.',
            'proteina.numeric' => 'Proteína deve ser um número.',
            'proteina.min' => 'Proteína não pode ser negativa.',
            'gordura.numeric' => 'Gordura deve ser um número.',
            'gordura.min' => 'Gordura não pode ser negativa.',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->messages()->all()[0],
                'success' => false,
            ]);
        }
    }
}
