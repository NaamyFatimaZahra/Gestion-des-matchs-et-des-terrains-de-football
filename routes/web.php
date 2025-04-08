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
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard'); 
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard'); 
    


    Route::get('services',action: [ServiceController::class,'index'])->name('admin.services.index');
    Route::post('services',action: [ServiceController::class,'store'])->name('admin.services.store');
    Route::patch('services/{service}/update', [ServiceController::class, 'update'])->name('admin.services.update'); //Route model binding =>Implicit
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy'); //Route model binding =>Implicit

    
    Route::get('terrains',action: [TerrainController::class,'index'])->name('admin.terrains.index');
    Route::patch('terrains/{terrain}/updateApproval', [TerrainController::class, 'updateApproval'])->name('admin.terrains.update-approval'); //Route model binding =>Implicit
    Route::get('/terrains/{terrain}',action: [TerrainController::class,'show'])->name('admin.terrain.show');


    Route::get('/users',action: [UserController::class,'index'])->name('admin.users.index');
    Route::patch('users/{user}/update-status', [UserController::class, 'updateStatus'])->name('admin.users.update-status'); //Route model binding =>Implicit
    Route::get('users/{id}',[UserController::class,'details'])->name('admin.users.detailsUser');
      
});

