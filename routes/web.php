<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\CategoryController;
use App\Models\Post;
use App\Models\Category;
 

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::patch('/posts/{post}/category', [CategoryController::class, 'updatePostCategory'])->name('posts.update-category');

Route::get('/posts', [PostController::class, 'index'])->name('posts.manage');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('post/{postId}', [PostController::class, 'show'])->name('post.show');
Route::view('/about', 'layouts.about')->name('about');
Route::view('/contact', 'layouts.contact')->name('contact');
Route::view('article', 'layouts.article')->name('article');
Route::get('signin', [SigninController::class, 'show'])->name('signin');
Route::post('signin', [SigninController::class, 'store'])->name('signin.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
