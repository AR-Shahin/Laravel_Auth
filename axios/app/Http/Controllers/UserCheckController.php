<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserCheckController extends Controller
{
    public function index()
    {
        return view('user-check');
    }

    public function checkUserExistsOrNot(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if ($user) {
            return "EXISTS";
        } else {
            return "NOT";
        }
    }
}
