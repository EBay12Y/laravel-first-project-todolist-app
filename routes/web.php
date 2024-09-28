<?php

use App\Http\Controllers\Halo\HaloController;
use App\Http\Controllers\ToDo\ToDoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', function () {
    echo "Test 123";
});

Route::get('/halo', [HaloController::class, 'index']);

Route::get('/todo', [ToDoController::class, 'index'])->name('todo');
Route::post('/todo', [ToDoController::class, 'store'])->name('todo.post');
Route::put('/todo/{id}', [ToDoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [ToDoController::class, 'destroy'])->name('todo.delete');
