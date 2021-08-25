<?php

use App\Mail\TestMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



Route::get('/', function () {
    // Mail::to('ars@mail.com')->send(new TestMail);
    // return 1;
    return redirect()->route('login');
});

# Login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('check.login');

# Logout
Route::post('logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

# Register
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register', [LoginController::class, 'registerStore'])->name('check.register');

# Forgot Password

Route::get('/forgot-password', function () {
    return view('forgot-password');
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


# Email verify

Route::get('/email/verify', function () {
    if (auth('web')->user()->email_verified_at) {
        return back();
    }
    return view('verify-email');
})->middleware(['auth'])->name('verification.notice');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');




# Dash board
Route::get('/dashboard', fn () => view('dash'))->middleware(['auth', 'custom_verify'])->name('dashboard');


Route::get(
    'user-test',
    fn () => 'Hello Shahin!'
)
    ->middleware(['auth', 'custom_verify']);


# Cache
Route::get('cache', function () {
    return 1;
});
