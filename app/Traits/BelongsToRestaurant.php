<?php

namespace App\Traits;

use App\Models\Restaurant;
use App\Models\Scopes\RestaurantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRestaurant
{
    public static function bootBelongsToRestaurant()
    {
        static::addGlobalScope(RestaurantScope::class);

        static::creating(function ($model) {
            $model->restaurant_id = auth()->user()->restaurant->id;
        });
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
