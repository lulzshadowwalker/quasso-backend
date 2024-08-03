<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Currency;
use App\Models\Restaurant;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'name' => '{"en": "'. $name .'"}',
            'slug' => Str::slug($name),
            'description' => '{"en": "'.$this->faker->paragraph().'"}',
            'currency_id' => Currency::factory(),
            'user_id' => User::factory(),
        ];
    }
}
