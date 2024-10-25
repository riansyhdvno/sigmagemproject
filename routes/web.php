<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListCategoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('/', [ListCategoryController::class, 'index']);


// Route::get('/', [CategoryController::class, 'index'])->name('home');
