<?php

namespace App\Http\Controllers;

use App\Mail\welcomEmail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
        request()->validate([
            'image' => 'image'
        ]);
        $imageFile = '';
        if (request()->has('image'))
            $imageFile = request()->file('image')->store('app', 'public');
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'image' => $imageFile
        ]);
        //Mail::to($user->email)->send(new welcomEmail($user));
        auth()->attempt($validated,true);
        return redirect()->route('dashboard')->with('success', 'Hello ' . $validated['name'] . ' welcome to our ideas platform');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate()
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (auth()->attempt($validated,true)) {
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'welcome back! ' . auth()->user()->name);
        }
        return redirect()->route('login')->withErrors([
            'email' => 'no mathcing email with this password was found!'
        ]);
    }

    //session is a way of storing info about the user login status, prefrences, shopping, etc, and has a unique id

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate(); //used to delete the session storage
        request()->session()->regenerateToken(); //generate new csrf token and stores it in the session
        return redirect()->route('login');
    }
}
