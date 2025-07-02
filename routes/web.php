<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
   return view('welcome', ['tasks' => Task::all()]);
});

Route::get('/welcome', function () {
    return view('welcome', ['tasks' => Task::all()]);
});

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::post('/welcome', [TaskController::class, 'create']);
