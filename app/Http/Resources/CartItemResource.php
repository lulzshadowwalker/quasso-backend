<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'cart-item',
            'id' => (string) $this->id,
            'attributes' => [
                'quantity' => $this->quantity,
                'unitPrice' => PriceResource::make((object) [
                    'amount' => $this->unit_price,
                    'currency' => $this->restaurant->currency,
                ]),
                //  TODO: Return thigns like total as a Total object with tax, subtotal, and whatnot
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' => (object) [],
            'links' => (object) [],
            'includes' => (object) [
                'item' => ItemResource::make($this->item),
                'cart' => $this->mergeWhen($this->includes('cart'), CartResource::make($this->cart)),
                'options' => CartItemOptionResource::collection($this->cartItemOptions ?: [])
            ],
        ];
    }
}
