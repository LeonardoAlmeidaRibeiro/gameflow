<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function show(Request $request)
    {
        return view('account.overview', [
            'user' => $request->user(),
        ]);
    }

    public function photo(Request $request)
    {
        $photo = ltrim((string) $request->user()->photo, '/');

        $paths = [
            public_path($photo),
            public_path('storage/' . $photo),
            storage_path('app/public/' . $photo),
        ];

        foreach ($paths as $path) {
            if (is_file($path)) {
                return response()->file($path);
            }
        }

        return response()->file(public_path('assets/media/avatars/300-1.jpg'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->merge([
            'cpf' => preg_replace('/\D/', '', (string) $request->input('cpf')),
            'phone' => preg_replace('/\D/', '', (string) $request->input('phone')),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'digits:11', Rule::unique('users', 'cpf')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:20240'],
        ], [
            'name.required' => 'O nome é obrigatório.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.digits' => 'O CPF deve conter 11 números.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'photo.image' => 'A foto precisa ser uma imagem.',
            'photo.mimes' => 'A foto deve estar em PNG, JPG, JPEG ou GIF.',
            'photo.max' => 'A foto deve ter no máximo 10 MB.',
        ]);

        unset($validated['photo']);

        $photo = $request->file('photo');

        if ($photo) {
            if (! $photo->isValid()) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Não foi possível enviar a foto. Tente novamente com outro arquivo.',
                        'errors' => [
                            'photo' => ['Não foi possível enviar a foto. Tente novamente com outro arquivo.'],
                        ],
                    ], 422);
                }

                return back()
                    ->withErrors(['photo' => 'Não foi possível enviar a foto. Tente novamente com outro arquivo.'])
                    ->withInput();
            }

            if ($user->photo) {
                $photoPaths = [
                    public_path(ltrim($user->photo, '/')),
                    public_path('storage/' . ltrim($user->photo, '/')),
                    storage_path('app/public/' . ltrim($user->photo, '/')),
                ];

                foreach ($photoPaths as $photoPath) {
                    if (is_file($photoPath)) {
                        unlink($photoPath);
                    }
                }
            }

            $directory = public_path('assets/media/profile-photos');

            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $filename = Str::uuid() . '.' . $photo->getClientOriginalExtension();
            $photo->move($directory, $filename);
            $validated['photo'] = 'assets/media/profile-photos/' . $filename;
        }

        $user->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Perfil atualizado com sucesso.',
                'photo_url' => route('account.photo'),
            ]);
        }

        return redirect()
            ->route('account.show')
            ->with('status', 'Perfil atualizado com sucesso.');
    }
}
