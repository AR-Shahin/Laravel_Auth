<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('task', TaskController::class)->except(['show', 'create']);
    Route::get('task_search/{query}', [TaskController::class, 'searchTask'])->name('task.search');
    Route::post('task_active/{task}', [TaskController::class, 'activeTask'])->name('task.active');
    Route::post('task_inactive/{task}', [TaskController::class, 'inactiveTask'])->name('task.inactive');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('test', function () {
    return response('');
});
