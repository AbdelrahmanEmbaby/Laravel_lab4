<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\PostsApiController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthApiController::class, 'register'])->name('api.register');
Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostsApiController::class, 'index'])->name('api.posts.index');
    Route::get('/posts/{id}', [PostsApiController::class, 'show'])->name('api.posts.show');
    Route::post('/posts', [PostsApiController::class, 'store'])->name('api.posts.store');
    Route::put('/posts/{id}', [PostsApiController::class, 'update'])->name('api.posts.update');
    Route::delete('/posts/{id}', [PostsApiController::class, 'destroy'])->name('api.posts.destroy');
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('api.logout');
});


Route::get('/test', function () {
    return response()->json(['status' => 'API is working']);
});