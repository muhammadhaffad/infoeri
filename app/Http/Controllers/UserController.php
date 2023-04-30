<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view_profile()
    {
        $profile = new User;
        $profile = $profile->where('id', Auth::user()->id)->first();
        return view('profile')->with('profile', $profile);
    }
}
