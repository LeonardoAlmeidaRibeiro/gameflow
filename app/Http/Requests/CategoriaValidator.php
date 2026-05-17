<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaValidator extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:200|unique:cad_bas_categoria,nome',
            'icone' => 'nullable|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo categoria é obrigatório.',
            'nome.unique' => 'Esta categoria já está sendo utilizada.',
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
