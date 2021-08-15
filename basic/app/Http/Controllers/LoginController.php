<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            return redirect()->route('login');
        }
    }
}
