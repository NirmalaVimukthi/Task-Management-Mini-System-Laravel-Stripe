<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;


Route::prefix('v1')->group(function () {

    //users CRUD
    Route::get('/users', [UserController::class, 'getAllUsers']);
    
    // Task CRUD Routes
    Route::get('/tasks', [TaskController::class, 'index']); // GET all tasks
    Route::post('/tasks', [TaskController::class, 'store']); // POST create a new task
    Route::get('/tasks/{id}', [TaskController::class, 'show']); // GET a specific task
    Route::put('/tasks/{id}', [TaskController::class, 'update']); // PUT update a task
  
    
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // DELETE a task

    // Additional routes to manage task-user relationships
    Route::post('/tasks/{id}/assign-users', [TaskController::class, 'assignUsers']); // Assign users to a task
    Route::get('/tasks/{id}/users', [TaskController::class, 'getUsers']); // Get users assigned to a task
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
