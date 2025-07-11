<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\BelongsToRestaurant;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\QueryFilter;
use App\Observers\ItemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(ItemObserver::class)]
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
            'restaurant_id' => 'integer',
            'gluten_free' => 'boolean',
            'lactose_free' => 'boolean',
            'vegan' => 'boolean',
            'new' => 'boolean',
            'popular' => 'boolean',
            'active' => 'boolean',
            'hidden' => 'boolean',
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function optionGroups(): HasMany
    {
        return $this->hasMany(OptionGroup::class);
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        $filters->apply($builder);
    }

    /**
     * Scope a query to only include visible (non hidden) items.
     */
    public function scopeVisible(Builder $builder)
    {
        $builder->where('hidden', false);
    }

    const MEDIA_COLLECTION_IMAGES = 'images';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION_IMAGES);
    }

    public function images(): Attribute
    {
        return Attribute::get(
            fn() => $this
                ->getMedia(self::MEDIA_COLLECTION_IMAGES)
                ->map(fn($media) => $media->getUrl()),
        );
    }

    public function imageFiles(): Attribute
    {
        return Attribute::get(fn() => $this->getMedia(self::MEDIA_COLLECTION_IMAGES));
    }
}
