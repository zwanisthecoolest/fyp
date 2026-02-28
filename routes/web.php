<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SigninController;
 

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');
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
