<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;

Route::get('/',[HomeController::class,'index']);
Route::get('/todo/upcoming',[TodoController::class,'upcomingTasks'])->name('todo.upcomingTasks');
Route::get('/todo/pastTasks',[TodoController::class,'pastTasks'])->name('todo.pastTasks');
Route::post('/todo/search',[TodoController::class,'search'])->name('todo.search');
Route::resource('/todo',TodoController::class)->middleware('auth')
->names([
    'index' => 'todo.index',
    'destroy' => 'todo.delete',
    'edit' => 'todo.edit',
    'update' => 'todo.update',
    'calendar' => 'todo.calendar',
    'pastTasks' => 'todo.pastTasks',
]);
Route::delete('/todo',[TodoController::class,'deleteMultiple'])->name('todo.deleteMultiple');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
