<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('user.index', ['user_id' => Auth::id()]);
        }

        return back()->withErrors([
            'username' => 'De combinatie gebruikersnaam en wachtwoord is niet correct.'
        ])->onlyInput('username');
    }

    public function showLoginForm() {
        
        return view('login.form');
    }
}
