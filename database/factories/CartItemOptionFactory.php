<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\Option;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItemOption>
 */
class CartItemOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_item_id' => CartItem::factory(),
            'option_id' => Option::factory(),
            'unit_price' => $this->faker->randomFloat(2, 1, 100),
            'restaurant_id' => Restaurant::factory(), //  NOTE: It doesn't really make sense when you have multiple properties each creating their own restaurant though this should never happen 
        ];
    }
}
