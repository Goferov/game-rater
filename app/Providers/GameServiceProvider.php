<?php

namespace App\Providers;

use App\Repository\GameRepository;
use App\Repository\GameRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            GameRepositoryInterface::class, GameRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
