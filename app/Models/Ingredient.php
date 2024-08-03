<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\BelongsToRestaurant;
use Spatie\Translatable\HasTranslations;

class Ingredient extends Model
{
    use HasFactory, BelongsToRestaurant, HasTranslations;

    public array $translatable = ['name'];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'array',
            'restaurant_id' => 'integer',
            'icon_id' => 'integer',
        ];
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }
}
