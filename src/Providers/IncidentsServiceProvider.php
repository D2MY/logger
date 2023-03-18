<?php

namespace D2my\Incidents\Providers;

use Illuminate\Support\ServiceProvider;

class IncidentsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/incidents.php' => config_path('incidents.php'),
            ], 'incidents');
        }
    }
}
