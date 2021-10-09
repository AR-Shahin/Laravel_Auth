<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('task', TaskController::class)->except(['show', 'create']);
Route::get('task_search/{query}', [TaskController::class, 'searchTask'])->name('task.search');
Route::get('test', function () {
    return response('');
});
