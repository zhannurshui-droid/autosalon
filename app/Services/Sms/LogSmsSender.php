<?php

namespace App\Services\Sms;

use App\Contracts\SmsSender;
use Illuminate\Support\Facades\Log;

class LogSmsSender implements SmsSender
{
    public function send(string $phone, string $text): void
    {
        if (str_ends_with($phone, '0000')) {
            throw new \RuntimeException("Не удалось отправить SMS на номер {$phone}");
        }

        Log::info("SMS → {$phone}: {$text}");
    }
}