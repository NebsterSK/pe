<?php

namespace Database\Factories;

use App\Models\Planet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'birth_year' => $this->faker->numberBetween(1, 100) . $this->faker->randomElement(['BBY', 'ABY']),
            'eye_color' => $this->faker->randomElement(['blue', 'green', 'brown', 'yellow', 'red', 'black', 'unknown', 'n/a']),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'unknown', 'n/a']),
            'hair_color' => $this->faker->randomElement(['black', 'brown', 'blonde', 'red', 'grey', 'white', 'unknown', 'n/a']),
            'height' => $this->faker->numberBetween(1, 300),
            'mass' => $this->faker->numberBetween(1, 300),
            'skin_color' => $this->faker->randomElement(['fair', 'light', 'dark', 'green', 'blue', 'red', 'unknown']),
            'planet_id' => Planet::factory(),
        ];
    }
}
