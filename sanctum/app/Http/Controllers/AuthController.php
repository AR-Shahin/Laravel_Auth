<?php

namespace App\Http\Controllers;

use App\Actions\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => File::upload($request->file('image'), 'user')
        ]);
        $success['token'] =  $user->createToken('SanctumAPI')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.', 201);
    }

    public function login(Request $request)
    {
        // return $request->all();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('user')->user();
            $success['token'] =  $user->createToken('SanctumAPI')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function me()
    {
        return response([
            'user' => auth('user')->user()
        ], 200);
    }
}
