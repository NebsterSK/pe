<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

test('command imports planets and residents', function () {
    $planetsData = planetsData();
    $residentsData = residentsData();

    Http::fake([
        config('services.swapi.base_url').'/planets*' => Http::sequence()
            ->push($planetsData)
            ->push(null, 404),
        config('services.swapi.base_url').'/people*' => Http::sequence()
            ->push($residentsData)
            ->push(null, 404),
    ]);


    $this->artisan('sync')
        ->expectsOutput('Planets & Residents sync started.')
        ->expectsOutput('Planets & Residents sync completed.')
        ->assertExitCode(Command::SUCCESS);

    $this->assertDatabaseCount('planets', 2);
    $this->assertDatabaseHas('planets', [
        'name' => $planetsData['results'][0]['name'],
    ]);

    $this->assertDatabaseCount('residents', 2);
    $this->assertDatabaseHas('residents', [
        'name' => $residentsData['results'][0]['name'],
    ]);
})->group('command');
