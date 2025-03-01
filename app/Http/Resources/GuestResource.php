<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestResource extends JsonResource
{
    protected string $token;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        assert($this->token, 'Token must be set before converting to array');

        return [
            'type' => 'guest',
            'id' => (string) $this->id,
            'attributes' => [
                'createdAt' => $this->created_at->toIso8601String(),
            ],
            'meta' => [
                'token' => $this->token,
            ],
            'links' => (object) [],
            'relationships' => (object) [],
        ];
    }

    public function token(string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
