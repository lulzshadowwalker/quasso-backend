<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => ['en' => Str::title($this->faker->sentence(rand(1, 3)))],
            'description' => ['en' => $this->faker->paragraph(rand(8, 10)) ],
            'price' => $this->faker->randomFloat(2, 1, 1000),

            'weight' => rand(0, 1) ? $this->faker->randomElement([ 100, 250, 450 ]) : null,
            'calories' => rand(0, 1) ? $this->faker->randomFloat(2, 100, 350) : null,
            'fat' => rand(0, 1) ? $this->faker->randomFloat(2, 1, 20) : null,
            'sugar' => rand(0, 1) ? $this->faker->randomFloat(2, 1, 20) : null,
            'carbohydrates' => rand(0, 1) ? $this->faker->randomFloat(2, 1, 50) : null,

            'is_gluten_free' => rand(0, 1) ? true : null,
            'is_lactose_free' => rand(0, 1) ? true : null,
            'is_vegan' => rand(0, 1) ? true : null,
            'is_new' => rand(0, 1) ? true : null,
            'is_popular' => rand(0, 1) ? true : null,
            'is_active' => true,
            'is_hidden' => false,

            'restaurant_id' => Restaurant::factory(),
        ];
    }
}
