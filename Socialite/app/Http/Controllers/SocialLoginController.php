<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function login($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        //return $provider;
        $userData = Socialite::driver($provider)->user();

        $user = User::whereEmail($userData->getEmail())->first();

        if (!$user) {
            $user =  User::create([
                'name' => $userData->getName(),
                'email' => $userData->getEmail(),
                'password' => bcrypt('password')
            ]);

            // Mail::to($user->email)->send(new SocialNewUserMail($user));
        }
        Auth::login($user);
        return redirect()->route('dashboard');
    }
}
