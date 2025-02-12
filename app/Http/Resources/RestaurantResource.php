<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'restaurant',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'currency' => CurrencyResource::make($this->currency),
                'logo' => $this->logo,
            ],
            'links' => (object) [],
            'relationships' => (object) [],
        ];
    }
}
