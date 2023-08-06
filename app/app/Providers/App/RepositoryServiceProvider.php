<?php

namespace App\Providers\App;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Services\Update\Repository\TelegramUpdateRepository;
use App\Services\Update\Repository\TelegramUpdateRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TelegramUpdateRepositoryInterface::class, function (Application $app) {
            return $app->make(TelegramUpdateRepository::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
