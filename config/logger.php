<?php

return [

    'enable' => env('LOGGER_ENABLED', true),

    'sync' => env('LOGGER_JOB_SYNC', false),

    'handler' => \D2my\Logger\WeeklyCustomLogger::class, // LogHandler::class

    'exception_channel' => null, // ChannelEnum::EXCEPTION->value

    // Если guard для определения юзера не дефолтный, то тут ключём будет канал, а значением guard
    // !!!! Применяется для всех логов данного канала !!!!
    // [
    //    ChannelEnum::API->value => 'api',
    // ]
    'channel_guards' => [],

    'token' => 'token', // Token для логгера, шлется в поле token в каждом запросе

];