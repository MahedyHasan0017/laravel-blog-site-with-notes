<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('home', [BlogPostController::class, 'home'])->name('home');
Route::get('single/post/{id}', [BlogPostController::class, 'single_post'])->name('single.post');
Route::get('post/create', [BlogPostController::class, 'post_create'])->name('post.create');
Route::post('post/create/store', [BlogPostController::class, 'post_create_store'])->name('post.store');


Route::get('post/update/{id}', [BlogPostController::class, 'post_update'])->name('post.update');

Route::put('post/update/{id}/store', [BlogPostController::class, 'post_update_store'])->name('post.update.store');

Route::delete('post/delete/{id}', [BlogPostController::class, 'post_delete_store'])->name('post.delete.store');


Route::get('posts/tag/{tag}', [PostTagController::class, 'index'])->name('posts.tags.index');


Route::post('post/{post}/comments', [PostCommentController::class, 'store'])->name('post.comment.store');
// Route::resource('post.comments', 'PostCommentController')->only(['store']);

Route::resource('users',UserController::class)->only(['show' , 'edit' , 'update']) ; 




require __DIR__ . '/auth.php';
