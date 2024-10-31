<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        // validation input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        //Attempt login
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        // login failed, return message error
        throw ValidationException::withMessages([
            'error' => 'Email atau password salah.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
}
