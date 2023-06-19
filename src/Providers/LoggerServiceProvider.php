<?php

namespace D2my\Logger\Providers;

use Illuminate\Support\ServiceProvider;

class LoggerServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/logger.php' => config_path('logger.php'),
            ], 'logger');
        }
    }
}
