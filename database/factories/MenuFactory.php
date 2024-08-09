<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Menu;
use App\Models\Restaurant;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $isScheduled = $this->faker->boolean();
        $startTime = $isScheduled ? $this->faker->time() : null;
        $endTime = $isScheduled ? Carbon::parse($startTime)->addHours(2) : null;

        return [
            'name' => ['en' => $this->faker->word()],
            'description' => ['en' => $this->faker->sentence()],
            'is_scheduled' => $isScheduled,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'restaurant_id' => Restaurant::factory(),
        ];
    }
}
