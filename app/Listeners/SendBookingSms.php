<?php

namespace App\Listeners;

use App\Contracts\SmsSender;
use App\Events\BookingCreated;

class SendBookingSms
{
    public function __construct(private SmsSender $sms) {}

    public function handle(BookingCreated $event): void
{
    try {
        $this->sms->send($event->booking->phone, '...текст...');
    } catch (\Throwable $e) {
        report($e);
    }
}
}