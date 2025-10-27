<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;

Route::get('/', [AccountController::class, 'login']);

Route::get('/register', [AccountController::class, 'register']);

Route::post('/register-user', [AccountController::class, 'register_user']);

Route::get('/dashboard/index', [DashboardController::class, 'index']);
