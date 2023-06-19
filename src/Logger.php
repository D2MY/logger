<?php

namespace D2my\Logger;

class Logger
{
    /**
     * @param array $config
     * @return LoggerService
     */
    public function __invoke(array $config): LoggerService
    {
        return new LoggerService($config['name'], ['with' => data_get($config, 'with')]);
    }
}