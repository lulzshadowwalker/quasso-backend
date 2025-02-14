<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'option-group',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'required' => $this->required,
                'selectionType' => $this->selection_type,
            ],
            'relationships' => (object) [],
            'links' => (object) [],
            'includes' => [
                'options' => OptionResource::collection($this->options),
            ],
        ];
    }
}
