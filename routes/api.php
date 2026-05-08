<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RegisterController;

Route::post('/register', [RegisterController::class, 'store']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::post('/login', [AuthController::class, 'login']);