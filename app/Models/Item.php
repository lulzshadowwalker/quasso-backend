<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\BelongsToRestaurant;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Item extends Model implements HasMedia
{
    use HasFactory, BelongsToRestaurant, InteractsWithMedia, HasTranslations;

    const MEDIA_COLLECTION = 'items';

    public array $translatable = ['name', 'description'];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'array',
            'description' => 'array',
            'price' => 'decimal',
            'category_id' => 'integer',
            'restaurant_id' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function itemOptions(): HasMany
    {
        return $this->hasMany(ItemOption::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }
}
