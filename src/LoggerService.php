<?php

namespace D2my\Logger;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class LoggerService implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @param  string  $channel
     * @param  array  $with
     */
    public function __construct(
        private readonly string $channel,
        private readonly array  $with
    ) {}

    /**
     * @param $level
     * @param \Stringable|string $message
     * @param array $context
     * @return void
     */
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        try {
            (is_null($job = config('logger.job.class')) ? LogJob::class : $job)::{config('logger.sync') ? 'dispatchSync' : 'dispatch'}($this->getLogData($message, $context, $this->with));
        } catch (\Throwable) {}
    }

    /**
     * @param  \Stringable|string  $message
     * @param  array  $context
     * @param  array  $with
     * @return array
     */
    protected function getLogData(\Stringable|string $message, array $context, array $with): array
    {
        $trace = $this->channel === config('logger.exception_channel') ?
            ['class' => data_get($context, 'class'), 'function' => data_get($context, 'method')] :
            debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)[5];

        return array_merge($with, [
            'data' => json_encode(
                array_merge($context, compact('message')), JSON_UNESCAPED_UNICODE
            ),
            'channel' => $this->channel,
            'ip' => request()->getClientIp() ?: null,
            'user_id' => Auth::guard(config("logger.channel_guards.$this->channel") ?? config('auth.defaults.guard', 'web'))->id(),
            'url' => url()->current() ?: null,
            'controller' => data_get($trace, 'class'),
            'method' => data_get($trace, 'function'),
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'token' => config('logger.token')
        ]);
    }

    /**
     * @return \Closure
     */
    public static function exceptionCallback(): \Closure
    {
        return function (\Throwable $e) {
            $ignore = config('logger.exception_ignore', []);

            foreach ($ignore as $exception => $regex) {
                if (is_int($exception)) {
                    [$exception, $regex] = [$regex, null];
                }

                if ($e::class !== $exception) {
                    continue;
                }

                if (is_null($regex) || (is_string($regex) && preg_match($regex, $e->getMessage()) === 1)) {
                    return;
                }
            }

            $request = request();
            $trace = array_map(fn($el) => Arr::except($el, 'args'), array_slice($e->getTrace(), 0, 50));

            Log::channel(config('logger.exception_channel'))->info(
                $e->getMessage(),
                [
                    'exception' => $e::class,
                    'trace' => $trace,
                    'request' => $request,
                    'headers' => $request->header(),
                    'data' => $request->all(),
                    'class' => $e->getFile(),
                    'method' => $trace[0]['function'] ?? 'Не известно',
                    'line' => $e->getLine(),
                ]
            );
        };
    }
}