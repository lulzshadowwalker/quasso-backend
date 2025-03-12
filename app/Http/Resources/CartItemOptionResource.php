<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'cart-item-option',
            'id' => (string) $this->id,
            'attributes' => [
                'unitPrice' => PriceResource::make((object) [
                    'amount' => $this->unit_price,
                    'currency' => $this->restaurant->currency,
                ]),
            ],
            'links' => (object) [],
            'relationships' => (object) [],
            'includes' => (object) [
                'option' => OptionResource::make($this->option),
            ],
        ];
    }
}
