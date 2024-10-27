<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    //---Register---//
    Route::inertia('/register', 'Auth/Register')->name('register');
    Route::post('/register',[AuthController::class, 'register']);

    //---Login---//
    Route::inertia('/login', 'Auth/Login')->name('login');
    Route::post('/login',[AuthController::class, 'login']);
});



