<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FriendController;
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

    //---Users---//
    Route::get('users', [UserController::class, 'showUsers'])->middleware('verified')->name('users');
    Route::post('users', [UserController::class, 'findUser'])->name('users.findUser');

    //---Friends---//
    Route::post('/friend-requests/send/{id}', [FriendController::class, 'sendRequest'])->name('friend.sendRequest');
    Route::post('/friend-requests/accept/{id}', [FriendController::class, 'acceptRequest'])->name('friend.accept');
    Route::post('/friend-requests/reject/{id}', [FriendController::class, 'rejectRequest'])->name('friend.reject');
    Route::post('/friend/remove/{id}', [FriendController::class, 'removeFriend'])->name('friend.remove');
    //Route::get('/friend-requests/pending', [FriendController::class, 'pendingRequests']);
    //Route::get('/friends', [FriendController::class, 'friends']);

    //---Events---//
    Route::get('events', [EventController::class, 'index'])->middleware('verified')->name('events');
    Route::post('events/join', [EventController::class, 'join'])->middleware('verified')->name('event.join');
    Route::post('events/accept', [EventController::class, 'accept'])->middleware('verified')->name('event.accept');
    Route::resource('event',EventController::class)->except('index');
});



