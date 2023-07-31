<?php

namespace D2my\Logger;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class LogJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private readonly array $log
    ) {
        $this->onQueue(config('logger.job.queue'));
    }

    /**
     *
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            if (!Http::post(config('logging.url'), $this->log)->ok()) {
                $this->fail();
            }
        } catch (\Throwable) {
            $this->release(config('logger.job.release_time'));
        }
    }
}
