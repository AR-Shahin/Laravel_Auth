<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::prefix('admin')->as('admin.')->group(function () {

    # Login
    Route::get('login', [AuthController::class, 'login'])->name('login')->middleware('guest:admin');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest:admin');

    # Register
    Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('guest:admin');
    Route::post('store', [AuthController::class, 'store'])->name('store')->middleware('guest:admin');


    # Logout
    Route::post('logout', function (Request $request) {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    })->name('logout');

    Route::get('/dashboard', fn () => view('admin.dash'))->middleware(['auth:admin', 'custom_verify'])->name('dashboard');

    Route::get(
        'admin-test',
        fn () => 'Hello Shahin!'
    )
        ->middleware(['auth:admin', 'custom_verify']);


    # Email verify

    Route::get('/email/verify', function () {
        if (auth('admin')->user()->email_verified_at) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.verify-email');
    })->middleware(['auth:admin'])->name('verification.notice');


    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:admin', 'throttle:6,1'])->name('verification.send');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('admin.dashboard');
    })->middleware(['auth:admin', 'signed'])->name('verification.verify');

    # Forgot Password

    Route::get('/forgot-password', function () {
        return view('admin.forgot-password');
    })->middleware('guest')->name('password.request');


    Route::post('/forgot-password', function (Request $request) {
        //  return $request;
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );
        // info($status);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');


    Route::get('/reset-password/{token}', function ($token) {
        return view('reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');



    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                // event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');
});
