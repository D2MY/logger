<?php

namespace D2my\Incidents\Services;

use D2my\Incidents\Contracts\IncidentHandler;

class IncidentsService
{
    /**
     * @param  string  $channel
     * @param  string  $message
     * @return void
     * @throws \Exception
     */
    public function send(string $channel, string $message): void
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)[1] ?? null;

        $class = data_get($trace, 'class');
        $method = data_get($trace, 'function');
        $line = data_get($trace, 'line');
        $time = now()->format('Y-m-d H:i:s');

        $handler = ($handler = config("incidents.channels.$channel.handler")) && $handler instanceof IncidentHandler ? $handler : DefaultHandler::class;

        app($handler)->handle($message, $class, $method, $line, $time);
    }
}