<?php

use App\Http\Controllers\Api\ReactionSessionController;
use App\Http\Controllers\Api\PythonPlayerAuthController;
use App\Http\Controllers\Api\LeaderboardController;
use App\Http\Controllers\Api\TrackProgressApiController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/reaction-sessions', [ReactionSessionController::class, 'index'])->name('api.reaction-sessions.index');
Route::post('/reaction-sessions', [ReactionSessionController::class, 'store'])->name('api.reaction-sessions.store');
Route::post('/python-player-login', [PythonPlayerAuthController::class, 'login'])->name('api.python-login');
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('api.leaderboard.index');
Route::get('/track-progress', [TrackProgressApiController::class, 'index'])->name('api.track-progress.index')->middleware('auth');
Route::get('/reviews/{gameName}', [ReviewController::class, 'index'])->name('api.reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('api.reviews.store');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('api.reviews.destroy');
