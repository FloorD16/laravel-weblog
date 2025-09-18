<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/premium', [PostController::class, 'premium'])->name('posts.premium')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts/{id}', [CommentController::class, 'store'])->name('comments.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');

Route::post('/logout', function () {
    Auth::logout();

    return redirect('/posts');
})->name('logout');

Route::get('/user/{user_id}', [UserController::class, 'index'])->name('user.index')->middleware('auth');
Route::get('/user/{user_id}/edit/{post_id}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/{user_id}/{post}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::delete('/user/{user_id}/{post}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');
Route::post('/user/{user_id}', [UserController::class, 'upgrade'])->name('user.upgrade')->middleware('auth');

Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('auth');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store')->middleware('auth');

// We voegen ook een redirect toe aan de routes die de hoofdpagina doorverwijst naar de '/posts' route
Route::redirect('/', '/posts');
