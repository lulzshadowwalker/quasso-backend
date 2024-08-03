<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\BelongsToRestaurant;
use Spatie\Translatable\HasTranslations;

class ItemOptionValue extends Model
{
    use HasFactory, BelongsToRestaurant, HasTranslations;

    public array $translatable = ['value'];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'value' => 'array',
            'price_modifier' => 'decimal',
            'item_option_id' => 'integer',
            'restaurant_id' => 'integer',
        ];
    }

    public function itemOption(): BelongsTo
    {
        return $this->belongsTo(ItemOption::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
