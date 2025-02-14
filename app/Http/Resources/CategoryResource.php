<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class CategoryResource extends BaseJsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'category',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'description' => $this->description,
            ],
            'links' => [
                'self' => route('api.categories.show', [
                    $this->restaurant->slug,
                    'lang' => app()->getLocale(),
                    'category' => $this->id,
                ]),
            ],
            'relationships' => [
                'items' => (object) [],
                'restaurant' => [
                    'data' => [
                        'type' => 'restaurant',
                        'id' => (string) $this->restaurant->id,
                    ],
                ],
            ],
            'includes' => (object) [
                'items' => $this->mergeWhen($this->includes('items'), ItemResource::collection($this->items)),
                'restaurant' => $this->mergewhen($this->includes('restaurant'), RestaurantResource::make($this->restaurant)),
            ],
        ];
    }
}
