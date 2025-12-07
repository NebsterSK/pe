<?php

use App\Enums\Mood;
use App\Enums\Weather;
use App\Models\Api\Logbook\Entry;
use App\Models\User;

test('unauthenticated user cannot access endpoints', function () {
    $this->getJson(route('api.logbook.entries.index'))->assertUnauthorized();
    $this->postJson(route('api.logbook.entries.store'))->assertUnauthorized();
})->group('api', 'logbook');

// Theoretical test, check that User without correct permissions cannot access endpoints
//test('unauthorized user cannot access endpoints', function () {
//
//})->group('api', 'logbook');

test('index endpoint returns list of logbook entries', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test-token')->plainTextToken;

    Entry::factory()->count(3)->create();

    $response = $this->withToken($token)->getJson(route('api.logbook.entries.index'))->assertOk();
    $response->assertJsonCount(3, 'data');
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'mood',
                'weather',
                'latitude',
                'longitude',
                'supplies_for_days',
                'note',
                'created_at',
                'updated_at',
            ],
        ],
    ]);
})->group('api', 'logbook');

test('store endpoint creates new logbook entry', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test-token')->plainTextToken;

    $data = [
        'mood' => fake()->randomElement(Mood::cases()),
        'weather' => fake()->randomElement(Weather::cases()),
        'latitude' => fake()->latitude(),
        'longitude' => fake()->longitude(),
        'supplies_for_days' => fake()->numberBetween(1, 30),
        'note' => fake()->sentence(),
    ];

    $response = $this->withToken($token)->postJson(route('api.logbook.entries.store'), $data)->assertCreated();
    $response->assertJsonStructure([
        'data' => [
            'id',
            'mood',
            'weather',
            'latitude',
            'longitude',
            'supplies_for_days',
            'note',
            'created_at',
            'updated_at',
        ],
    ]);

    $this->assertDatabaseCount('logbook_entries', 1);
})->group('api', 'logbook');