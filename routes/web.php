<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create', [App\Http\Controllers\TaskController::class, 'create'])->name('create');

Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks');

Route::get('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('edit');

