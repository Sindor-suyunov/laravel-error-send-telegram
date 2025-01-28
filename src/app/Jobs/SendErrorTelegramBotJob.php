<?php

namespace Sindor\LaravelErrorSendTelegram\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sindor\LaravelErrorSendTelegram\App\Contracts\ErrorSenderContract;

class SendErrorTelegramBotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public ErrorSenderContract $service,
        public string $text
    )
    {
    }

    public function handle(): void
    {
        $this
            ->service
            ->setText($this->text)
            ->send();

    }

    public function failed(\Throwable $throwable): void
    {
        logger()->error($throwable);
    }

}
