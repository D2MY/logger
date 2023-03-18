<?php

namespace D2my\Incidents\Contracts;

interface IncidentHandler
{
    public function handle(string $message, string $class, string $method, int $line, string $time): void;
}