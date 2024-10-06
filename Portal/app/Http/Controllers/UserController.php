<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Login(){
        return View('login-form');
    }

    public function Logged(){
        return redirect()->action([MainController::class, 'Index']);
    }

    public function Register(){
        return View('register-form');
    }

    public function Registered(){


        $user = User::create([
            'name' => request()->get('name',''),
            'email' => request()->get('email',''),
            'password' => request()->get('password',''),
        ]);

        return redirect()->action([MainController::class, 'Index']);
    }
}
