<?php

return [

    'enable' => env('LOGGER_ENABLED', true),

    'sync' => env('LOGGER_JOB_SYNC', false),

    'job' => [
        'class' => null, //если null - будет использоваться дефолтная жоба, иначе Job::class
        'queue' => env('LOGGER_JOB_QUEUE', 'logs'),
        'release_time' => env('LOGGER_RELEASE_TIME', 180),
    ],

    'exception_channel' => null, // ChannelEnum::EXCEPTION->value

    // игнорирует ошибки, удовлетворяющие условиям. если нет ключа массива, то игнорируются все такие ошибки.
    // если в качестве ключа указана ошибка, то значением должно быть регулярное выражение, фильтрующее ->getMessage() ошибки
    'exception_ignore' => [
        //Exception::class,
        //Exception::class => 'regex',
    ],

    'ignored_channel' => null, //если указан, игнорируемые ошибки будут отсылаться в этот канал

    // Если guard для определения юзера не дефолтный, то тут ключём будет канал, а значением guard
    // !!!! Применяется для всех логов данного канала !!!!
    // [
    //    ChannelEnum::API->value => 'api',
    // ]
    'channel_guards' => [],

    'token' => 'token', // Token для логгера, шлется в поле token в каждом запросе

];