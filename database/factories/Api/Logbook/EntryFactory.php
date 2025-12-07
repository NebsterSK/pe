<?php

namespace Database\Factories\Api\Logbook;

use App\Enums\Mood;
use App\Enums\Weather;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Logbook\Entry>
 */
class EntryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mood' => $this->faker->randomElement(Mood::cases()),
            'weather' => $this->faker->randomElement(Weather::cases()),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'supplies_for_days' => $this->faker->numberBetween(1, 30),
            'note' => $this->faker->sentence(),
        ];
    }
}
