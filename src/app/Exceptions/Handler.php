<?php

namespace Sindor\LaravelErrorSendTelegram\App\Exceptions;

use Sindor\LaravelErrorSendTelegram\App\Service\Sender;

class Handler extends \Illuminate\Foundation\Exceptions\Handler
{
    public function report(\Throwable $e): void
    {
        parent::report($e);

        Sender::handle($e);
    }
}
