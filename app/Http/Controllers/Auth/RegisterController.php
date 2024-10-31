<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    public function register(Request $request)
    {
        // Validate data input
        $request->validate([
            'email' => [
                'required',
                'email',
                'max:64',
                Rule::unique('users', 'email'), // pastikan email unik
            ],
            'full_name' => 'required|string|max:64',
            'no_hp' => 'required|digits_between:10,13', // sesuaikan dengan format no hp
            'password' => 'required|min:8', // konfirmasi password
        ]);

        //create new user
        User::create([
            'email' => $request->email,
            'full_name' => $request->full_name,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        //redirect or login after registration
        return redirect()->route('login')->with('success', 'Registrasi berhasil, selamat datang!');
    }
}
