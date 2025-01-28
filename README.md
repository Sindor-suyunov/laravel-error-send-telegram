# About

Helpful Tool to handle and send error messages via telegram bot

## Installation and usage

**1. Install package to your laravel project**

```bash
composer require sindor/laravel-error-send-telegram
```
**2. Publish files**

```bash
php artisan vendor:publish --tag=laravel-error
```
**3. Telegram bot config (To access send message your users must have a chat with bot)**

```bash
.env ERROR_TELEGRAM_BOT_TOKEN="<your-token>"
.env ERROR_TELEGRAM_USERS_IDS=<id1>,<id2>
```

# Configuration

**You can configure**

```bash
  path: config/laravel-error.php
```

**You can customize stub file(template of message)**

```bash
  path: stubs/laravel-error/message.stub
```
