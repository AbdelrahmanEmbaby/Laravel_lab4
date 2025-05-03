<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/create', [App\Http\Controllers\PostsController::class, 'create'])->name('posts.create');

    Route::get('/posts/{id}/edit', [App\Http\Controllers\PostsController::class, 'edit'])->name('posts.edit');

    Route::post('/posts', [App\Http\Controllers\PostsController::class, 'store'])->name('posts.store');

    Route::put('/posts/{id}', [App\Http\Controllers\PostsController::class, 'update'])->name('posts.update');

    Route::delete('/posts/{id}', [App\Http\Controllers\PostsController::class, 'destroy'])->name('posts.destroy');
});

Route::get('/posts', [App\Http\Controllers\PostsController::class, 'index'])->name('posts.index');

Route::get('/posts/{id}', [App\Http\Controllers\PostsController::class, 'show'])
    ->name('posts.show')
    ->where('id', '[0-9]+');

require __DIR__.'/auth.php';
