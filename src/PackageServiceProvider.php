<?php

namespace Sindor\LaravelErrorSendTelegram;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;
use Sindor\LaravelErrorSendTelegram\App\Exceptions\Handler;

class PackageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config/laravel-error.php' => config_path('laravel-error.php'),
            __DIR__ . '/app/Stubs/message.stub' => base_path('stubs/laravel-error/message.stub'),
        ], 'laravel-error');

    }
}
