<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
    Route::post('/dashboard',[UserController::class, 'changePfp'])->name('changePfp');
    Route::inertia('/dashboard', 'Dashboard')->name('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register',[AuthController::class, 'register']);

    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login',[AuthController::class, 'login']);
});




