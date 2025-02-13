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
                //  TODO: When adding something like Brick/Money we need to wrap all the prices in http resources into a PriceResource
                'price' => [
                    'amount' => $this->price,
                    'currency' => CurrencyResource::make($this->restaurant->currency),
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
            'includes' => (object) [
                'category' => $this->mergeWhen($this->includes('category'), CategoryResource::make($this->category)),
                'restaurant' => $this->mergewhen($this->includes('restaurant'), RestaurantResource::make($this->restaurant)),
            ],
        ];
    }
}
