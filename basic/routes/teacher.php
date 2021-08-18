<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::prefix('teacher')->as('teacher.')->group(function () {

    Route::get('login', [TeacherController::class, 'login'])->name('login')->middleware('guest:teacher');

    Route::post('authenticate', [TeacherController::class, 'authenticate'])->name('authenticate')->middleware('guest:teacher');

    # Register
    Route::get('register', [TeacherController::class, 'register'])->name('register')->middleware('guest:teacher');
    Route::post('store', [TeacherController::class, 'store'])->name('store')->middleware('guest:teacher');


    # Logout
    Route::post('logout', function (Request $request) {
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    })->name('logout');

    Route::get('/dashboard', fn () => view('teacher.dash'))->middleware(['auth:teacher', 'custom_verify'])->name('dashboard');



    Route::get('/email/verify', function () {
        if (auth('teacher')->user()->email_verified_at) {
            return redirect()->route('teacher.dashboard');
        }
        return view('teacher.verify-email');
    })->middleware(['auth:teacher'])->name('verification.notice');


    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:teacher', 'throttle:6,1'])->name('verification.send');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('teacher.dashboard');
    })->middleware(['auth:teacher', 'signed'])->name('verification.verify');
});
