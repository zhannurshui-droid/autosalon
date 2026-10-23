<?php

namespace App\Listeners;

use App\Contracts\SmsSender;
use App\Events\BookingCreated;

class SendBookingSms
{
    public function __construct(private SmsSender $sms) {}

    public function handle(BookingCreated $event): void
    {
        $booking = $event->booking->loadMissing('car');

        $this->sms->send(
            $booking->phone,
            "Заявка №{$booking->id} на тест-драйв «{$booking->car->title}» принята."
        );
    }
}