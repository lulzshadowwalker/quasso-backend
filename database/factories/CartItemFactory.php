<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 1, 100),
            'item_id' => Item::factory(),
            'restaurant_id' => Restaurant::factory(),
            'cart_id' => Cart::factory(),
        ];
    }
}
