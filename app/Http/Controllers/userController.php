<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    //
    public function index()
    {
        return view('setting');
    }
    public function update(Request $request)
    {
        if (Hash::check($request->oldpassword, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->newpassword);
            $user->save();
            return "Successfully updated";
        } else {
            // The provided old password does not match
            return "Old password is incorrect.";
        }
    }
}
