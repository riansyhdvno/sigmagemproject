<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ListCategoryController;

// Route::get('/', function () {
//     return view('home');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ListCategoryController::class, 'index'])->name('home');
});

Route::get('/profile', function () {
    return view('user.profile.edit');
});

// Regis dan Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
// Route::get('/dashboard', [AuthController::class, 'dashboard']);


// Route::get('/home', [ListCategoryController::class, 'index']);

// Route::get('/', [CategoryController::class, 'index'])->name('home');
