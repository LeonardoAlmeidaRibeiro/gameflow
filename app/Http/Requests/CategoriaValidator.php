<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return ['nome' => 'required|string|min:3|max:200|unique:cad_bas_categoria,nome'];
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
                'success' => false
            ]);
        }
    }
}
