<?php

use App\Http\Controllers\AuthController;
use Illuminate\Routing\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');