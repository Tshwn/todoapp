<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;

Route::get('/',[HomeController::class,'index']);
Route::resource('/todo',TodoController::class)->middleware('auth')
->names([
    'index' => 'todo.index',
    'destroy' => 'todo.delete',
    'update' => 'todo.update',
    'calendar' => 'todo.calendar',
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
