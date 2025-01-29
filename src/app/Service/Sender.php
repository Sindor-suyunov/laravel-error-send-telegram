<?php

namespace Sindor\LaravelErrorSendTelegram\App\Service;

use Sindor\LaravelErrorSendTelegram\App\Jobs\SendErrorTelegramBotJob;
use Sindor\LaravelErrorSendTelegram\App\TelegramBot;

class Sender
{
    public string $text = '';

    public function setThrowable(\Throwable $e): static
    {
        $this->text = StubService::make($e)->getAsText();

        return $this;
    }

    public static function handle(\Throwable $e): void
    {
        if (!config('laravel-error.enabled')) {
            return;
        }

        $self = new self();
        $self->setThrowable($e);

        SendErrorTelegramBotJob::dispatch(
            TelegramBot::make(), $self->text
        );
    }
}
