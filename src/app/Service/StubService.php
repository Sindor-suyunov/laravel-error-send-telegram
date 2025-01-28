<?php

namespace Sindor\LaravelErrorSendTelegram\App\Service;

class StubService
{
    public array $data = [];

    public function __construct(
        public \Throwable $exception
    ) {
        $this->data = [
            '$MESSAGE$' => $this->exception->getMessage(),
            '$FILE$' => $this->exception->getFile(),
            '$LINE$' => $this->exception->getLine(),
            '$DATE$' => now()->toDateTimeString(),
            '$APP_NAME$' => env('APP_NAME', 'Application'),
            '$APP_HOST$' => env('APP_URL', 'localhost'),
            '$APP_ENV$' => env('APP_ENV', 'local'),
            '$AUTH_USER_ID$' => auth()->check() ? auth()->user()->id : 'null',
        ];
    }

    public static function make(\Throwable $e): StubService
    {
        return new self($e);
    }

    public function getAsText(): array|bool|string
    {
        $content = file_get_contents($this->getStubPath());

        foreach ($this->data as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $content;
    }

    protected function getStubPath()
    {
        return config('laravel-error.stub_path');
    }
}
