<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\TerrainController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard'); 
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard'); 
    
 // Resource services avec alias personnalisés
    Route::resource('services', ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'show' => 'admin.services.show',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);
    
    // Vous pouvez également ajouter une resource pour la gestion des terrains
    Route::resource('terrains', TerrainController::class)->names([
        'index' => 'admin.terrains.index',
        'create' => 'admin.terrains.create',
        'store' => 'admin.terrains.store',
        'show' => 'admin.terrains.show',
        'edit' => 'admin.terrains.edit',
        'update' => 'admin.terrains.update',
        'destroy' => 'admin.terrains.destroy',
    ]);

    Route::get('/users',[UserController::class,'index'])->name('admin.users.index');
    
});

