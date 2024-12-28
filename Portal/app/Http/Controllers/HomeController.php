<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index() {
        if (Auth::user()){
            $events = User::findOrFail(Auth::id())->events()->where('status','>',0)->get();
        } else {
            $events = null;
        }

        return Inertia::render('Home', ['events' => $events], );
    }
}
