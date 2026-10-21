<?php

namespace App\Models;

use App\Observers\CarObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([CarObserver::class])]
class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id', 'title', 'year', 'price', 'mileage', 'in_stock', 'description', 'cover', 'attachment',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'price' => 'decimal:2',
            'mileage' => 'integer',
            'in_stock' => 'boolean',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeInStock(Builder $query)
    {
        $query->where('in_stock', true);
    }

    public function scopeSearch(Builder $query, ?string $text): void
    {
        $query->when($text, function ($q) use ($text) {
            $q->where(fn ($w) => $w->where('title', 'like', "%{$text}%")
                ->orWhere('description', 'like', "%{$text}%"));
        });
    }

    protected function coverUrl(): Attribute
    {
        return Attribute::get(fn () => $this->cover
            ? asset('storage/' . $this->cover)
            : asset('images/no-cover.png'));
    }
}