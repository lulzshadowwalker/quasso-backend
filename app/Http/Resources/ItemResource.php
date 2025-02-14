<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ItemResource extends BaseJsonResource
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
                'price' => PriceResource::make((object) [
                    'amount' => $this->price,
                    'currency' => $this->restaurant->currency,
                ]),
            ],
            'links' => [
                'self' => route('api.items.show', [
                    $this->restaurant->slug,
                    'lang' => app()->getLocale(),
                    'item' => $this->id,
                ]),
            ],
            'relationships' => [
                'categories' => (object) [],
                'restaurant' => [
                    'data' => [
                        'type' => 'restaurant',
                        'id' => (string) $this->restaurant_id,
                    ],
                ],
            ],
            'includes' => (object) [
                'categories' => $this->mergeWhen($this->includes('categories'), CategoryResource::collection($this->categories)),
                'restaurant' => $this->mergewhen($this->includes('restaurant'), RestaurantResource::make($this->restaurant)),
                'optionGroups' => $this->mergewhen($this->includes('optionGroups'), OptionGroupResource::collection($this->optionGroups)),
            ],
        ];
    }
}
