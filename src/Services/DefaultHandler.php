<?php

namespace D2my\Incidents\Services;

use D2my\Incidents\Contracts\IncidentHandler;
use Illuminate\Support\Facades\Log;

class DefaultHandler implements IncidentHandler
{
    /**
     * @param  string  $message
     * @param  string  $class
     * @param  string  $method
     * @param  int  $line
     * @param  string  $time
     * @return void
     */
    public function handle(string $message, string $class, string $method, int $line, string $time): void
    {
        Log::info($message, [
            'class' => $class,
            'method' => $method,
            'line' => $line,
            'time' => $time
        ]);
    }
}