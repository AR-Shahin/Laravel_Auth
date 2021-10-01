<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectOnProviders($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        //return 111;
        $userSocial = Socialite::driver($provider)->user();

        $user = User::whereEmail($userSocial->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'password' => 'password'
            ]);
        };

        Auth::guard('web')->login($user);
        return redirect()->route('dashboard');
    }
}
