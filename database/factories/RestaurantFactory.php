<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Currency;
use App\Models\Restaurant;
use Illuminate\Support\Str;

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
        $name = ['en' => $this->faker->unique()->name(), 'ru' => $this->faker->name()];
        $slug = Str::slug($name['en']);

        return [
            'name' => $name,
            'slug' =>  $slug,
            'description' => ['en' => $this->faker->paragraph()],
            'currency_id' => Currency::factory(),
            'user_id' => User::factory(),
        ];
    }
}
