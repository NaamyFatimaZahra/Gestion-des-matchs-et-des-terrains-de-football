<?php

namespace App\Providers;

use App\Repositories\Interface\TerrainRepositoryInterface;
use App\Repositories\Eloquent\TerrainRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
     public function boot(): void
    {
        Schema::defaultStringLength(191); 
    }
}
