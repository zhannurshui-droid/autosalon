<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'status'       => $this->status,
            'status_label' => Booking::STATUSES[$this->status] ?? $this->status,
            'phone'        => $this->phone,
            'comment'      => $this->comment,
            'car'          => new CarResource($this->whenLoaded('car')),
            'created_at'   => $this->created_at?->toIso8601String(),
        ];
    }
}