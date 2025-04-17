<?php

namespace App\Providers;

use App\Repositories\Eloquent\DashboardRepository;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Interface\CommentRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\TerrainRepositoryInterface;
use App\Repositories\Eloquent\TerrainRepository;
use App\Repositories\Interface\DashboardRepositoryInterface;
use App\Repositories\Eloquent\ReservationRepository;
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
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(ReservationRepositoryInterface::class,ReservationRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
     public function boot(): void
    {
        Schema::defaultStringLength(191); 
    }
}
