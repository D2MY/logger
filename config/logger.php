<?php

return [

    'enable' => false,

    'job' => null, //Job::class

    'handler' => null, // LogHandler::class

    'time_format' => 'Y-m-d H:i:s',

    'exception_channel' => null, // ChannelEnum::EXCEPTION->value

    // Если guard для определения юзера не дефолтный, то тут ключём будет канал, а значением guard
    // !!!! Применяется для всех логов данного канала !!!!
    // [
    //    ChannelEnum::API->value => 'api',
    // ]
    'channel_guards' => [],

    'token' => 'token', // Token для логгера, шлется в поле token в каждом запросе

];