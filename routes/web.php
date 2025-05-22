<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});
    

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
