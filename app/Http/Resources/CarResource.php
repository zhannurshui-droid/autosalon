<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'year'        => $this->year,
            'price'       => (float) $this->price,
            'mileage'     => $this->mileage,
            'in_stock'    => $this->in_stock,
            'description' => $this->description,
            'cover_url'   => $this->cover_url,
            'brand'       => new BrandResource($this->whenLoaded('brand')),
            'created_at'  => $this->created_at?->toIso8601String(),
            'links'       => [
                'self' => route('api.v1.cars.show', $this->id),
            ],
        ];
    }
}