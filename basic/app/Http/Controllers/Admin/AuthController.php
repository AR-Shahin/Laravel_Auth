<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminRegisterEvent;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'password' => ['required'],
        ]);
        // if ($request->remember) {
        //     $credentials['remember'] =  true;
        // }
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function register()
    {
        return view('admin.register');
    }
    public function store(Request $request)
    {
        //  return $request->all();
        $user = Admin::create($request->all());
        if ($user) {
            event(new AdminRegisterEvent($user));
            Auth::guard('admin')->login($user);
            // Auth::login($user);
            return redirect()->route('admin.dashboard');
        }
    }
}
