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

    Route::put('/tasks/{id}/complete', [TaskController::class, 'complete']); // PUT update a task
    Route::post('/tasks/{id}/pay', [TaskController::class, 'pay']); // Payment for a task

    Route::get('/payment/callback', [TaskController::class, 'handleCallback'])->name('payment.callback');

});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
