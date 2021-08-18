<?php

namespace App\Http\Controllers;

use App\Events\TeacherRegisterEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    function login()
    {
        return view('teacher.login');
    }

    function authenticate(Request $request)
    {
        //return $request->all();
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:teachers,email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('teacher')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('teacher/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    function register()
    {
        return view('teacher.register');
    }

    function store(Request $request)
    {
        // return $request->all();
        $user = Teacher::create($request->all());
        if ($user) {
            event(new TeacherRegisterEvent($user));
            Auth::guard('teacher')->login($user);

            return redirect()->route('teacher.dashboard');
        }
    }
}
