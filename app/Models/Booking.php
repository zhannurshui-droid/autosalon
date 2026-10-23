<?php

namespace App\Models;

use App\Observers\BookingObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([BookingObserver::class])]
class Booking extends Model
{
    public const STATUSES = [
        'new'       => 'Новая',
        'processed' => 'Обработана',
        'rejected'  => 'Отклонена',
    ];

    protected $fillable = ['user_id', 'car_id', 'phone', 'comment', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}