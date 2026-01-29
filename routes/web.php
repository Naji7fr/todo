<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Home: redirect to tasks when logged in, else to login
Route::get('/', fn () => auth()->check() ? redirect()->route('tasks.index') : redirect()->route('login'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('tasks.index'))->name('dashboard');

    Route::patch('tasks/{task}/status', [TaskController::class, 'setStatus'])->name('tasks.set-status');
    Route::post('tasks/clear-completed', [TaskController::class, 'clearCompleted'])->name('tasks.clear-completed');
    Route::resource('tasks', TaskController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
