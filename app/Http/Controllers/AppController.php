<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{
    public function home()
    {
        $event = new Event;
        $categories = new Category;
        return view('home')->with('events', $event)->with('cats', $categories);
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'username' => 'required|max:50',
                'password' => 'required|min:8',
            ]);

            if (Auth::attempt($credentials)) {
                if (Auth::user()->role === 'admin') {
                    $request->session()->regenerate();
                    return redirect()->intended('/admin/event');
                }
                $request->session()->regenerate();
                return redirect()->intended('/');
                return back()->with('status', 'Username atau password salah!');
                dd('selain user');
            }
            return back()->with('status', 'Username atau password salah!');
        }
        return view('login');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $validatedData = $request->validate(
                [
                    'first_name' => 'required|max:100',
                    'last_name' => 'required|max:100',
                    'email' => 'required|email:dns',
                    'username' => 'required|max:50',
                    'password' => 'required|max:100|min:8',
                    'phone_number' => 'required|max:20'
                ]
            );

            $user = new User;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->firstname = $request->first_name;
            $user->lastname = $request->last_name;
            $user->phone = $request->phone_number;
            $user->role = 'user';
            $user->save();

            return back()->with('success', 'User berhasil dibuat!');
        }
        return view('register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
