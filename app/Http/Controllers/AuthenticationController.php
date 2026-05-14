<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
