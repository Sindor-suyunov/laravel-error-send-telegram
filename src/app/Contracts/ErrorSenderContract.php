<?php

namespace Sindor\LaravelErrorSendTelegram\App\Contracts;

interface ErrorSenderContract
{
    public static function make(): static;

    public function send(): void;

    public function setText(string $text): static;
}
