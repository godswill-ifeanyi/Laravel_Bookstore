<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
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

Route::prefix('/admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/index', [AdminController::class, 'index']);

    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/books', [AdminController::class, 'books']);
    Route::get('/books/create', [AdminController::class, 'create_book']);
    Route::post('/books', [AdminController::class, 'store_book']);
    Route::get('/books/{id}', [AdminController::class, 'show_book']);
    Route::get('/books/{id}/edit', [AdminController::class, 'edit_book']);
    Route::put('/books/{id}', [AdminController::class, 'update_book']);
    Route::delete('/books/{id}', [AdminController::class, 'delete_book']);
});
