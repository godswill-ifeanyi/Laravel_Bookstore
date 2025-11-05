<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;

Route::get('/', [AccountController::class, 'login'])->name('login');

Route::get('/register', [AccountController::class, 'register'])->name('register');

Route::post('/register-user', [AccountController::class, 'register_user']);

Route::post('/login-user', [AccountController::class, 'login_user']);

Route::post('/logout-user', [AccountController::class, 'logout_user']);

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/index', [DashboardController::class, 'index']);

    Route::resource('books', BookController::class);
});
