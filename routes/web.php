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

Route::get('home', [BlogPostController::class , 'home'])->name('home');
Route::get('single/post/{id}', [BlogPostController::class , 'post'])->name('single.post');
Route::get('post/create', [BlogPostController::class , 'post_create'])->name('post.create');
Route::post('post/store', [BlogPostController::class , 'post_create_store'])->name('post.store');

