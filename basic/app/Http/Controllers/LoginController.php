<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('register');
    }

    public function registerStore(Request $request)
    {
        $user = User::create($request->all());
        if ($user) {
            event(new Registered($user));
            // Auth::login($user);
            return redirect()->route('login');
        }
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required'],
        ]);
        // if ($request->remember) {
        //     $credentials['remember'] =  true;
        // }
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
