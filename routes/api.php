<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'store']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::post('/login', [AuthController::class, 'login']);