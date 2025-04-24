<?php

use App\Http\Controllers\admin\DashboardController as adminDashboard;
use App\Http\Controllers\proprietaire\CommentController as proprietaireComment;
use App\Http\Controllers\joueur\CommentContoller as joueurComment;
use App\Http\Controllers\proprietaire\DashboardController as proprietaireDashboard;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\TerrainController as adminTerrain;
use App\Http\Controllers\proprietaire\ReservationController;
use App\Http\Controllers\proprietaire\TerrainController as proprietaireTerrain;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\joueur\TerrainController as joueurTerrain;  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TerrainController as TerrainController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\joueur\SquadContoller;
use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/terrains',[TerrainController::class,'index'])->name('terrains');
Route::get('/terrains/{id}',[TerrainController::class,'show'])->name('details_terrain');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update-picture');

});

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
    Route::get('/terrains/{terrain}', [adminTerrain::class,'show'])->name('admin.terrain.show');

//admin users
    Route::get('/users',action: [UserController::class,'index'])->name('admin.users.index');
    Route::patch('users/{user}/update-status', [UserController::class, 'updateStatus'])->name('admin.users.update-status'); //Route model binding =>Implicit
    Route::get('users/{id}',[UserController::class,'details'])->name('admin.users.detailsUser');

});


//proprietaire

Route::prefix('proprietaire')->middleware(['auth','role:proprietaire','status'])->group(function(){

    //proprietaire dashboard
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

    //proprietaire reservations
    Route::get('/reservations',[ReservationController::class,'index'])->name('proprietaire.reservation.index'); 
    Route::patch('/reservations/{id}',[ReservationController::class,'updateStatus'])->name('proprietaire.reservation.update-status'); 

    

    //proprietaire commentaires
    Route::get('/comments',[proprietaireComment::class,'index'])->name('proprietaire.comments.index');
    Route::delete('/comment/{comment}',[proprietaireComment::class,'destroy'])->name('proprietaire.comment.destroy');
  

});


Route::prefix('joueur')->middleware(['auth','role:joueur','checkPlayerStatus'])->group(function(){
    Route::get('/squads',[SquadContoller::class,'index'])->name('joueur.squads');
    Route::get('/squadBuilder',[SquadContoller::class,'create'])->name('joueur.squadBuilder.create'); 
    Route::post('/squadBuilder',[SquadContoller::class,'store'])->name('joueur.squadBuilder.store');
    Route::get('/squad/joueur/{city}/{squadId}', [SquadContoller::class, 'getSquadPlayers'])->name('joueur.squad.players');
    Route::post('/squad/joueur', [SquadContoller::class, 'storePlayer'])->name('joueur.squad.add');
    Route::get('/squad/{id}',[SquadContoller::class,'show'])->name('joueur.squad.show');
    Route::delete('/comments/{id}',[joueurComment::class,'destroy'])->name('joueur.comment.destroy');
    Route::post('/comments',[joueurComment::class,'store'])->name('joueur.comment.store');
});





