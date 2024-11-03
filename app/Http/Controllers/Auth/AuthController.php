<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        // Validate data input
        $request->validate([
            'full_name' => 'required|string|max:64',
            'email' => [
                'required',
                'email',
                'max:64',
                Rule::unique('users', 'email'), // pastikan email unik
            ],
            'no_hp' => 'required|digits_between:10,13', // sesuaikan dengan format no hp
            'password' => 'required|min:8', // konfirmasi password
        ]);

        //create new user
        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10)
        ]);

        //redirect or login after registration
        return redirect()->route('login')->with('success', 'Registrasi berhasil, selamat datang!');
    }

}
