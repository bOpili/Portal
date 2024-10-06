<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'Index']);

Route::get('/login-form', [UserController::class, 'Login']);

Route::post('/', [UserController::class, 'Logged']);

Route::get('/register-form', [UserController::class, 'Register']);

Route::post('/', [UserController::class, 'Registered']);

