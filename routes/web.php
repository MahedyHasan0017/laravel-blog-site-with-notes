<?php

use App\Http\Controllers\BlogPostController;
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

Route::get('hello', function () {
    return "hello laravel";
});

Route::get('home', [BlogPostController::class, 'home'])->name('home');
Route::get('single/post/{id}', [BlogPostController::class, 'post'])->name('single.post');
Route::get('post/create', [BlogPostController::class, 'post_create'])->name('post.create');
Route::post('post/create/store', [BlogPostController::class, 'post_create_store'])->name('post.store');


Route::get('post/update/{id}', [BlogPostController::class, 'post_update'])->name('post.update');

Route::put('post/update/{id}/store', [BlogPostController::class, 'post_update_store'])->name('post.update.store');

Route::delete('post/delete/{id}', [BlogPostController::class, 'post_delete_store'])->name('post.delete.store');
