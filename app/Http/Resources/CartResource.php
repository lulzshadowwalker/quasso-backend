<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'cart',
            'id' => (string) $this->id,
            'attributes' => [
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' => [
                'restaurant' => [
                    'data' => [
                        'type' => 'restaurant',
                        'id' => (string) $this->restaurant_id,
                    ],
                ],
                'guest' => [
                    'data' => [
                        'type' => 'guest',
                        'id' => (string) $this->guest_id,
                    ],
                ],
            ],
            'link' => (object) [],
            'includes' => (object) [
                'cartItems' => CartItemResource::collection($this->cartItems),
            ],
        ];
    }
}
