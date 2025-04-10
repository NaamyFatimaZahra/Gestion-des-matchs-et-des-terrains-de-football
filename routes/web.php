<?php

use App\Http\Controllers\admin\DashboardController as adminDashboard;
use App\Http\Controllers\proprietaire\DashboardController as proprietaireDashboard;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\TerrainController as adminTerrain;
use App\Http\Controllers\proprietaire\TerrainController as proprietaireTerrain;
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


//admin
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function () {
    Route::get('/',[adminDashboard::class,'index'])->name('admin.dashboard'); 
    Route::get('/dashboard',[adminDashboard::class,'index'])->name('admin.dashboard'); 
    

//admin service
    Route::get('services',action: [ServiceController::class,'index'])->name('admin.services.index');
    Route::post('services',action: [ServiceController::class,'store'])->name('admin.services.store');
    Route::patch('services/{service}/update', [ServiceController::class, 'update'])->name('admin.services.update'); //Route model binding =>Implicit
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy'); //Route model binding =>Implicit

//admin terrains  
    Route::get('terrains',action: [adminTerrain::class,'index'])->name('admin.terrains.index');
    Route::patch('terrains/{terrain}/updateApproval', [adminTerrain::class, 'updateApproval'])->name('admin.terrains.update-approval'); //Route model binding =>Implicit
    Route::get('/terrains/{terrain}',action: [adminTerrain::class,'show'])->name('admin.terrain.show');

//admin users
    Route::get('/users',action: [UserController::class,'index'])->name('admin.users.index');
    Route::patch('users/{user}/update-status', [UserController::class, 'updateStatus'])->name('admin.users.update-status'); //Route model binding =>Implicit
    Route::get('users/{id}',[UserController::class,'details'])->name('admin.users.detailsUser');

});




Route::prefix('proprietaire')->middleware(['auth','role:proprietaire','status'])->group(function(){
    Route::get('/',[proprietaireDashboard::class,'index'])->name('proprietaire.dashboard'); 
    Route::get('/dashboard',[proprietaireDashboard::class,'index'])->name('proprietaire.dashboard');
    
    //proprietaire terrains
    Route::resource('terrains',proprietaireTerrain::class)->names(
        [
            'index' => 'proprietaire.terrains.index',
            'create' => 'proprietaire.terrain.create',
            'store' => 'proprietaire.terrain.store',
            'show' => 'proprietaire.terrain.show',
            'edit' => 'proprietaire.terrain.edit',
            'update' => 'proprietaire.terrain.update',
            'destroy' => 'proprietaire.terrain.destroy',
        ]
    );
    Route::patch('terrain/{terrain}/update-status',[proprietaireTerrain::class,'updateStatus'])->name('proprietaire.terrain.update-status');
});