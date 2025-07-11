<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'option',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'price' => PriceResource::make((object) [
                    'amount' => $this->price,
                    'currency' => $this->restaurant->currency,
                ]),
            ],
            'relationships' => (object) [],
            'links' => (object) [],
        ];
    }
}
