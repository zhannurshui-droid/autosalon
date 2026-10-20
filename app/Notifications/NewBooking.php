<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBooking extends Notification
{
    public function __construct(public Booking $booking)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Новая заявка №{$this->booking->id}")
            ->greeting('Здравствуйте!')
            ->line($this->text())
            ->action('Открыть заявки', route('admin.bookings.index'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'text'       => $this->text(),
        ];
    }

    private function text(): string
    {
        return "Новая заявка №{$this->booking->id} на тест-драйв «{$this->booking->car->title}» "
             . "от {$this->booking->user->name} ({$this->booking->phone})";
    }
}