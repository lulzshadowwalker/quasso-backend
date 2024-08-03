<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\BelongsToRestaurant;
use Spatie\Translatable\HasTranslations;

class ItemOption extends Model
{
    use HasFactory, BelongsToRestaurant, HasTranslations;

    public array $translatable = ['name'];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'array',
            'item_id' => 'integer',
            'restaurant_id' => 'integer',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function itemOptionValues(): HasMany
    {
        return $this->hasMany(ItemOptionValue::class);
    }
}
