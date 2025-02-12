<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'item',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
                'price' => [
                    'value' => $this->price,
                    'currency' => $this->restaurant->currency->code,
                ],
            ],
            'links' => [
                'self' => route('api.items.show', [
                    $this->restaurant->slug,
                    'lang' => app()->getLocale(),
                    'item' => $this->id,
                ]),
            ],
            'relationships' => [
                'category' => [
                    'data' => [
                        'type' => 'category',
                        'id' => (string) $this->category_id,
                    ],
                ],
                'restaurant' => [
                    'data' => [
                        'type' => 'restaurant',
                        'id' => (string) $this->restaurant_id,
                    ],
                ],
            ],
        ];
    }
}
