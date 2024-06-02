<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\UserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        /*$this->app->singleton(UserRepositoryInterface::class, function ($app) {
            return new UserRepository (
                $app->make(User::class)
            );
        });*/

        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}
