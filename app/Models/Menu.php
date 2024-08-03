<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\BelongsToRestaurant;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory, BelongsToRestaurant, HasTranslations;

    public array $translatable = ['name', 'description'];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'array',
            'description' => 'array',
            'is_scheduled' => 'boolean',
            'restaurant_id' => 'integer',
        ];
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }
}
