<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
                'restaurant' => [
                    'data' => [
                        'type' => 'restaurant',
                        'id' => (string) $this->restaurant->id,
                    ],
                ],
            ],
        ];
    }
}
