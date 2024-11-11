<?php

namespace App\Http\Controllers\Auth;

use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
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
        // dd("Metode login diakses.");
        // validation input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        //Attempt login for customers
        if (Auth::guard('customer')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // dd("Login berhasil, akan diarahkan ke halaman utama.");
            return redirect()->intended(route('home'));
        }

        // login failed, return message error
        throw ValidationException::withMessages([
            'error' => 'Email atau password salah.'
        ]);


    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

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
                Rule::unique('customers', 'email'), // pastikan email unik
            ],
            'no_hp' => 'required|digits_between:10,13|unique:customers,no_hp', // sesuaikan dengan format no hp
            'password' => 'required|min:8', // konfirmasi password
        ]);

        //create new user
        Customer::create([
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

    public function editProfile()
    {
    // Mendapatkan data pengguna saat ini
        $user = Auth::guard('customer')->user();
        return view('user.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return redirect()->route('edit-profile')->with('error', 'User tidak ditemukan.');
        }

        // Validate profile update input
        $request->validate([
            'full_name' => 'required|string|max:64',
            'email' => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($user->id),
            ],
            'no_hp' => 'required|digits_between:10,13|unique:customers,no_hp,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        // Collect data to update
        $data = $request->only('full_name', 'email', 'no_hp');

        // If password is provided, hash and update it
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('home')->with('success', 'Profil berhasil diperbarui.');
    }


}
