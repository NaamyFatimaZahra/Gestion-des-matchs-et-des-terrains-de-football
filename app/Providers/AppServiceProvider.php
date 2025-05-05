<?php

namespace App\Providers;

use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\ServiceRepository;
use App\Repositories\Eloquent\SquadRepository;
use App\Repositories\Interface\CommentRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\ServiceRepositoryInterface;
use App\Repositories\Interface\SquadRepositoryInterface;
use App\Repositories\Interface\TerrainRepositoryInterface;
use App\Repositories\Eloquent\TerrainRepository;
use App\Repositories\Eloquent\ReservationRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Services\AuthService;
use App\Services\Interfaces\ProfileServiceInterface;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TerrainRepositoryInterface::class, TerrainRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class,ReservationRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SquadRepositoryInterface::class, SquadRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
         $this->app->bind(ProfileServiceInterface::class, ProfileService::class);
    }

    /**
     * Bootstrap any application services.
     */
     public function boot(): void
    {
        Schema::defaultStringLength(191); 
    }
}
