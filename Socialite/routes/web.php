<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/redirect/{provider}', [SocialLoginController::class, 'login'])->name(('social.login'));
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('social.callback');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
