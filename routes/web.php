<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;

// Vista principal
Route::get('/', function () {
   return view('welcome', ['tasks' => Task::all()]);
});

Route::get('/welcome', function () {
    return view('welcome', ['tasks' => Task::all()]);
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::post('/new_task', [TaskController::class, 'create']);

// API REST (devuelve JSON si se solicita desde JS o Postman)
Route::prefix('api')->group(function () {
    Route::get('/token', [TaskController::class, 'api_getCsrfToken']);
    Route::get('/tasks', [TaskController::class, 'api_index']);
    Route::post('/new_task', [TaskController::class, 'api_create']);
    Route::put('/tasks/{id}', [TaskController::class, 'api_update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'api_destroy']);
});
