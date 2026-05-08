<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RegisterController;
   

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class,'dashboard']);
});