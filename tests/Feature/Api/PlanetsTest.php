<?php

use App\Models\Planet;
use App\Models\User;

test('unauthenticated user cannot access endpoints', function () {
    $this->getJson(route('api.planets.largest'))->assertUnauthorized();
})->group('api', 'planets');

// Theoretical test, check that User without correct permissions cannot access endpoints
// test('unauthorized user cannot access endpoints', function () {
//
// })->group('api', 'logbook');

test('largest endpoint returns list of 10 largest planets', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test-token')->plainTextToken;

    Planet::factory()->count(20)->create();

    $expectedPlanets = Planet::orderBy('diameter', 'desc')->limit(10)->get(['name', 'diameter']);

    $response = $this->withToken($token)->getJson(route('api.planets.largest'))->assertOk();
    $response->assertJsonCount(10);
    $response->assertJson($expectedPlanets->toArray());
})->group('api', 'planets');
