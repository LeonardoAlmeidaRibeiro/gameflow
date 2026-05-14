<?php

namespace App\Validators;

class UserValidator
{
    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'digits:11', 'unique:users,cpf'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['required', 'same:password'],
            'toc' => ['accepted'],
        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'Informe um nome válido.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.digits' => 'O CPF deve conter 11 números.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'confirm-password.required' => 'Confirme sua senha.',
            'confirm-password.same' => 'As senhas não conferem.',
            'toc.accepted' => 'Você precisa aceitar os termos de uso.',
        ];
    }
}
