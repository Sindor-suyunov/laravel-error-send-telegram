<?php

return [
    'bot_token' => env('ERROR_TELEGRAM_BOT_TOKEN', ''),
    'users_telegram_ids' => explode(',' , env('ERROR_TELEGRAM_USERS_IDS', [])),
    'stub_path' => base_path('stubs/laravel-error/message.stub'),
    'parse_mode' => 'markdown'
];
