<?php

namespace App\Models\Scopes;

use App\Factories\RestaurantFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class RestaurantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $restaurant = RestaurantFactory::make();
        if (! $restaurant) {
            throw new \Exception('Restaurant not found');
        }

        $builder->where('restaurant_id', $restaurant->id);
    }
}
