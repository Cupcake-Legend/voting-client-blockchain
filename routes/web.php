<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TPSController;
use App\Http\Controllers\VoteController;

// Redirect root to login
Route::get('/', fn() => redirect()->route('login'));

// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Admin-only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('tps', TPSController::class);
    Route::get('/admin/vote-results', [VoteController::class, 'showVoteResultForm'])->name('vote-results.form');
    Route::post('/admin/vote-results', [VoteController::class, 'submitVoteResults'])->name('vote-results.submit');
});

// Voter-only
Route::middleware(['auth', 'role:voter'])->group(function () {
    Route::get('/dashboard', [VoteController::class, 'index'])->name('dashboard');
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');
});
