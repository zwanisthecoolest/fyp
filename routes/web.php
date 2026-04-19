<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
 

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/login', 'layouts.login')->name('login.page');
Route::view('/register', 'layouts.register')->name('register.page');
Route::view('/track-progress', 'layouts.track-progress')->name('track.progress');
Route::view('/mini-games', 'mini-games')->name('mini-games');
Route::view('/leaderboard', 'leaderboard')->name('leaderboard');
Route::view('/guides', 'guides')->name('guides');
Route::view('/reviews', 'reviews')->name('reviews');
Route::view('/profile', 'profile')->name('profile');
Route::view('/contact', 'contact')->name('contact');

