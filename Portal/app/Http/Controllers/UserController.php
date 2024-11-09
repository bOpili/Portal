<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController
{
    public function changePfp(Request $request){
        $request->validate([
            'pfp' => ['file', 'nullable']
        ]);

        if ($request->hasFile('pfp')) {
            $pfp = Storage::disk('public')->put('ProfilePictures',$request->pfp);
            DB::update('update users set profilepic = ? where id = ?',[$pfp, Auth::id()]);
        }
    }
}
