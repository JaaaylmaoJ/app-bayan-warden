<?php

namespace App\Providers\App;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Services\User\Repository\TgUserRepository;
use App\Services\Chat\Repository\TgChatRepository;
use App\Services\User\Repository\TgUserRepositoryInterface;
use App\Services\Chat\Repository\TgChatRepositoryInterface;
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
        $this->app->singleton(TgUserRepositoryInterface::class, function (Application $app) {
            return $app->make(TgUserRepository::class);
        });
        $this->app->singleton(TgChatRepositoryInterface::class, function (Application $app) {
            return $app->make(TgChatRepository::class);
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
