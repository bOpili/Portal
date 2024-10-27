<?php

use Illuminate\Support\Facades\Route;
require __DIR__ . '/user/auth.php';
require __DIR__ . '/user/guest.php';

//---Home page---//
Route::inertia('/', 'Home')->name('home');

//---Events---//
Route::inertia('events', 'Events')->middleware('verified')->name('events');




