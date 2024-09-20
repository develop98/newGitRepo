<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [TaskController::class, 'dashboard'])->name('home');

// Route::post('/tasks/create', [TaskController::class, 'createTask'])->name('tasks.create');
Route::get('/tasks/create', function () {
    return view('task.create');
})->name('tasks.create');

// Route to handle task creation
Route::post('/tasks/store', [TaskController::class, 'createTask'])->name('tasks.store');

// Route to show the edit form
Route::get('/tasks/edit/{id}', [TaskController::class, 'editTask'])->name('tasks.edit');

// Route to handle task updates
Route::put('/tasks/update/{id}', [TaskController::class, 'updateTask'])->name('tasks.update');

// Route to handle task deletion
Route::delete('/tasks/delete/{id}', [TaskController::class, 'deleteTask'])->name('tasks.delete');


Route::get('/tasks/edit/{id}', [TaskController::class, 'editTask'])->name('tasks.edit');
