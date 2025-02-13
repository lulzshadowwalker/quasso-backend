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
use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;

class Item extends Model implements HasMedia
{
    use HasFactory, BelongsToRestaurant, InteractsWithMedia, HasTranslations;

    //  TODO: Add a slug to items ?
    public array $translatable = ['name', 'description'];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'array',
            'description' => 'array',
            'price' => 'decimal:2',
            'category_id' => 'integer',
            'restaurant_id' => 'integer',
        ];
    }

    //  TODO: Shouldn't a item be allowed to belong to multiple categories ?
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

    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }
}
