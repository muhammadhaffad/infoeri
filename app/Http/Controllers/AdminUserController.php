<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function update_user(Request $request) {
        $request->validate(
            [
                'user_id' => 'required',
                'user_firstname' => 'required|max:100',
                'user_lastname' => 'required|max:100',
                'user_email' => 'required|email:dns',
                'user_phone' => 'required|max:20'
            ]
        );

        $user = User::find($request->user_id);
        $user->email = $request->user_email;
        $user->firstname = $request->user_firstname;
        $user->lastname = $request->user_lastname;
        $user->phone = $request->user_phone;
        if (isset($request->user_password) && $request->user_password != null) {
            $user->password = Hash::make($request->user_password);
        }
        $user->save();
        return back();
    }

    public function view_user(Request $request) {
        $users = new User;
        return view('admin.user')->with('users', $users);
    }

    public function delete_user(Request $request) {
        $user = User::find($request->user_id);
        $user->delete();
        return back();
    }
}
