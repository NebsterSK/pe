<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planet>
 */
class PlanetFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->colorName(),
            'diameter' => $this->faker->numberBetween(1_000, 50_000),
            'rotation_period' => $this->faker->numberBetween(10, 1_000),
            'orbital_period' => $this->faker->numberBetween(100, 10_000),
            'gravity' => $this->faker->randomElement(['0.5 standard', '1 standard', '1.5 standard', '2 standard']),
            'population' => $this->faker->numberBetween(0, 10_000_000_000),
            'climate' => $this->faker->randomElement(['arid', 'temperate', 'tropical', 'frozen', 'murky']),
            'terrain' => $this->faker->randomElement(['desert', 'forest', 'mountains', 'oceans', 'plains']),
            'surface_water' => $this->faker->numberBetween(0, 100),
        ];
    }
}
