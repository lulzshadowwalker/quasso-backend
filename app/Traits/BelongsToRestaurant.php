<?php

namespace App\Traits;

use App\Factories\RestaurantFactory;
use App\Models\Restaurant;
use App\Models\Scopes\RestaurantScope;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRestaurant
{
    public static function bootBelongsToRestaurant()
    {
        static::addGlobalScope(RestaurantScope::class);

        if (! RestaurantFactory::make()) {
            throw new Exception('Restaurant not found');
        }

        static::creating(function ($model) {
            //  WARNING: If use a closure to captura the the result from above, it would cause some test cases to fail
            $model->restaurant_id = RestaurantFactory::make()->id;
        });
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
