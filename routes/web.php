<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ListCategoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('/', [ListCategoryController::class, 'index']);

// Regis dan Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/registration', [AuthController::class, 'registration'])->name('register');
Route::post('/post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/home', [ListCategoryController::class, 'index']);

// Route::get('/', [CategoryController::class, 'index'])->name('home');
