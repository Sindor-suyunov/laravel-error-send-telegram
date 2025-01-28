<?php

namespace Sindor\LaravelErrorSendTelegram\App;

use Sindor\LaravelErrorSendTelegram\App\Contracts\ErrorSenderContract;

class TelegramBot implements ErrorSenderContract
{
    protected string $bot_token = '';
    protected array $user_ids = [];

    protected bool $is_valid_config = false;

    protected string $text = '';

    public function __construct()
    {
        $this->bot_token = config('laravel-error.bot_token');
        $this->user_ids = config('laravel-error.users_telegram_ids');

        if (!empty($this->bot_token) AND !empty($this->user_ids)) {
            $this->is_valid_config = true;
        } else {
            logger()->error('LaravelErrorSendTelegram: Telegram Bot not configured');
        }
    }

    public static function make(): static
    {
        return new self();
    }

    protected function getUrl(): string
    {
        return "https://api.telegram.org/bot{$this->bot_token}/sendMessage";
    }

    public function send(): void
    {
        if ($this->is_valid_config) {

            foreach ($this->user_ids as $user_id){
//                dd($this->text);
                $response = \Http::get($this->getUrl(), [
                    'chat_id' => $user_id,
                    'text' => $this->text,
                    'parse_mode' => 'markdown'
                ]);
                if ($response->ok()) {
                    logger()->info("LaravelErrorSendTelegram: Exception error successfully sent. (User id = {$user_id})");
                } else {
                    logger()->error("LaravelErrorSendTelegram: Exception error does not sent: Something is wrong. (User id = {$user_id})");
                    logger()->error($response->json());
                }
            }
        }
    }

    public function setText(string $text): static
    {
        $this->text = $text;
        return $this;
    }
}
