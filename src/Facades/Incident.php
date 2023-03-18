<?php

namespace D2my\Incidents\Facades;

use D2my\Incidents\Services\IncidentsService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void  send(string $channel, string $message);
 */
class Incident extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return IncidentsService::class;
    }
}