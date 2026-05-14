<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * Exibe a página de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('authentication.sign-in');
    }

    public function resetPassword()
    {
        return view('authentication.reset-password');
    }

    public function checkResetEmail(Request $request)
    {
        $validated = $request->validate(
            ['email' => ['required', 'email', 'exists:users,email']],
            [
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'Informe um e-mail válido.',
                'email.exists' => 'Não encontramos uma conta com este e-mail.',
            ]
        );

        $request->session()->put('password_reset_email', $validated['email']);

        return redirect()->route('new-password');
    }

    public function newPassword(Request $request)
    {
        if (! $request->session()->has('password_reset_email')) {
            return redirect()
                ->route('reset-password')
                ->withErrors(['email' => 'Informe seu e-mail antes de redefinir a senha.']);
        }

        return view('authentication.new-password', [
            'email' => $request->session()->get('password_reset_email'),
        ]);
    }

    public function updatePassword(Request $request)
    {
        $email = $request->session()->get('password_reset_email');

        if (! $email) {
            return redirect()
                ->route('reset-password')
                ->withErrors(['email' => 'Informe seu e-mail antes de redefinir a senha.']);
        }

        $validated = $request->validate(
            [
                'password' => ['required', 'string', 'min:8'],
                'confirm-password' => ['required', 'same:password'],
            ],
            [
                'password.required' => 'A senha é obrigatória.',
                'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
                'confirm-password.required' => 'Confirme sua senha.',
                'confirm-password.same' => 'As senhas não conferem.',
            ]
        );

        $user = User::where('email', $email)->first();

        if (! $user) {
            $request->session()->forget('password_reset_email');

            return redirect()
                ->route('reset-password')
                ->withErrors(['email' => 'Não encontramos uma conta com este e-mail.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $request->session()->forget('password_reset_email');

        return redirect()
            ->route('login')
            ->with('success', 'Senha atualizada com sucesso. Faça login para continuar.');
    }


    /**
     * Processa o envio do formulário de login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only(['email', 'password']);

        if (auth()->attempt($credentials)) {
            return redirect()->intended(route('index'));
        }

        return back()->withErrors(['email' => 'As credenciais estão incorretas.'])->withInput();
    }

    /**
     * Faz logout do usuário.
     *
     * @return \Illuminate\Http\RedirectResponse
     */


    public function signUp(Request $request)
    {
        return view('authentication.sign-up');
    }

    public function store(Request $request)
    {
        $request->merge([
            'cpf' => preg_replace('/\D/', '', (string) $request->input('cpf')),
        ]);

        $validated = $request->validate(
            UserValidator::rules(),
            UserValidator::messages()
        );

        User::create([
            'name' => $validated['name'],
            'cpf' => $validated['cpf'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Conta criada com sucesso. Faça login para continuar.');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
