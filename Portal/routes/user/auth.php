<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    //---Logout---//
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    //---Dashboard---//
    Route::post('/dashboard',[UserController::class, 'changePfp'])->name('changePfp');
    Route::inertia('/dashboard', 'Auth/Dashboard')->name('dashboard');

    //---Email verification---//
    Route::get('/email/verify', [AuthController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'handler'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resend'])->middleware('throttle:6,1')->name('verification.send');

    //---Friends---//
    Route::inertia('friends', 'Auth/Friends')->middleware('verified')->name('friends');
    Route::post('friends', [UserController::class, 'findUser'])->name('friends.findUser');

    //---Events---//
    Route::inertia('events', 'Events')->middleware('verified')->name('events');
});



