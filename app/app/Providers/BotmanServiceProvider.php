<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Components\Botman\BotmanHandlerInterface;

class BotmanServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(BotmanHandlerInterface::class, function (Application $app) {
            return $app->make('botman');
        });
    }
}