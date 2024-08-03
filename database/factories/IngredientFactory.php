<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Icon;
use App\Models\Ingredient;
use App\Models\Restaurant;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => '{}',
            'description' => '{}',
            'icon' => $this->faker->word(),
            'color' => $this->faker->word(),
            'restaurant_id' => Restaurant::factory(),
            'icon_id' => Icon::factory(),
        ];
    }
}
