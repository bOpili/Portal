<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function changePfp(Request $request){
        $request->validate([
            'pfp' => ['file', 'nullable']
        ]);

        if ($request->hasFile('pfp')) {
            $pfp = Storage::disk('public')->put('ProfilePictures',$request->pfp);
            User::find(Auth::id())->update(['profilepic' => $pfp]);
        }
    }

    public function showUsers(){
        $requests = User::findOrFail(Auth::id())->receivedFriendRequests()->where('status', 'pending')->with('sender:id,name,profilepic')->get();
        if($requests->isEmpty()) {
            $requests = null;
        }
        $users = User::findOrFail(Auth::id())->friends;
        $friends = $users;
        return Inertia::render('Auth/Users',['users'=>$users, 'requests' => $requests, 'friends' => $friends]);
    }

    public function findUser(Request $request){
        $found = User::where('name','=',$request->Name)->get();
        $friends = User::findOrFail(Auth::id())->friends;

        if($found->isEmpty()){
            return back();
        }

        return Inertia::render('Auth/Users',['users'=>$found, 'friends' => $friends]);
    }

}
