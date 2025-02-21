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

                'weight' => $this->weight,
                'calories' => $this->calories,
                'fat' => $this->fat,
                'carbohydrates' => $this->carbohydrates,
                'protein' => $this->protein,
                'sugar' => $this->sugar,

                'glutenFree' => (bool) $this->gluten_free,
                'lactoseFree' => (bool) $this->lactose_free,
                'vegan' => (bool) $this->vegan,
                'new' => (bool) $this->new,
                'popular' => (bool) $this->popular,
                'active' => (bool) $this->active,
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
