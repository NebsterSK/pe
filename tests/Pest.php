<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use App\Enums\Mood;
use App\Enums\Weather;

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\LazilyRefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function planetsData(): array
{
    return [
        'count' => 2,
        'next' => null,
        'previous' => null,
        'results' => [
            [
                'url' => config('services.swapi.base_url') . '/planets/1/',
                'name' => fake()->colorName(),
                'diameter' => (string) fake()->numberBetween(1_000, 50_000),
                'rotation_period' => (string) fake()->numberBetween(10, 1_000),
                'orbital_period' => (string) fake()->numberBetween(100, 10_000),
                'gravity' => fake()->randomElement(['0.5 standard', '1 standard', '1.5 standard', '2 standard']),
                'population' => (string) fake()->numberBetween(0, 10_000_000_000),
                'climate' => fake()->randomElement(['arid', 'temperate', 'tropical', 'frozen', 'murky']),
                'terrain' => fake()->randomElement(['desert', 'forest', 'mountains', 'oceans', 'plains']),
                'surface_water' => (string) fake()->numberBetween(0, 100),
            ],
            [
                'url' => config('services.swapi.base_url') . '/planets/2/',
                'name' => fake()->colorName(),
                'diameter' => (string) fake()->numberBetween(1_000, 50_000),
                'rotation_period' => (string) fake()->numberBetween(10, 1_000),
                'orbital_period' => (string) fake()->numberBetween(100, 10_000),
                'gravity' => fake()->randomElement(['0.5 standard', '1 standard', '1.5 standard', '2 standard']),
                'population' => (string) fake()->numberBetween(0, 10_000_000_000),
                'climate' => fake()->randomElement(['arid', 'temperate', 'tropical', 'frozen', 'murky']),
                'terrain' => fake()->randomElement(['desert', 'forest', 'mountains', 'oceans', 'plains']),
                'surface_water' => (string) fake()->numberBetween(0, 100),
            ],
        ],
    ];
}

function residentsData(): array
{
    return [
        'count' => 2,
        'next' => null,
        'previous' => null,
        'results' => [
            [
                'url' => config('services.swapi.base_url') . '/people/1/',
                'name' => fake()->name(),
                'birth_year' => fake()->numberBetween(1, 100) . fake()->randomElement(['BBY', 'ABY']),
                'eye_color' => fake()->randomElement(['blue', 'green', 'brown', 'yellow', 'red', 'black', 'unknown', 'n/a']),
                'gender' => fake()->randomElement(['Male', 'Female', 'unknown', 'n/a']),
                'hair_color' => fake()->randomElement(['black', 'brown', 'blonde', 'red', 'grey', 'white', 'unknown', 'n/a']),
                'height' => (string) fake()->numberBetween(1, 300),
                'mass' => (string) fake()->numberBetween(1, 300),
                'skin_color' => fake()->randomElement(['fair', 'light', 'dark', 'green', 'blue', 'red', 'unknown']),
                'homeworld' => config('services.swapi.base_url') . '/planets/1/',
            ],
            [
                'url' => config('services.swapi.base_url') . '/people/2/',
                'name' => fake()->name(),
                'birth_year' => fake()->numberBetween(1, 100) . fake()->randomElement(['BBY', 'ABY']),
                'eye_color' => fake()->randomElement(['blue', 'green', 'brown', 'yellow', 'red', 'black', 'unknown', 'n/a']),
                'gender' => fake()->randomElement(['Male', 'Female', 'unknown', 'n/a']),
                'hair_color' => fake()->randomElement(['black', 'brown', 'blonde', 'red', 'grey', 'white', 'unknown', 'n/a']),
                'height' => (string) fake()->numberBetween(1, 300),
                'mass' => (string) fake()->numberBetween(1, 300),
                'skin_color' => fake()->randomElement(['fair', 'light', 'dark', 'green', 'blue', 'red', 'unknown']),
                'homeworld' => config('services.swapi.base_url') . '/planets/2/',
            ],
        ],
    ];
}
