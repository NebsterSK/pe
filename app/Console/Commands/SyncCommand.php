<?php

namespace App\Console\Commands;

use App\Models\Planet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class SyncCommand extends Command
{
    protected $signature = 'sync';

    protected $description = 'Sync data of all planets and residents from SWAPI to local database.';

    public function handle(): int
    {
        $this->info('Planets & Residents sync started.');
        Log::info('Planets & Residents sync started', [
            'command' => $this->getName(),
        ]);

        // Planets
        $url = config('services.swapi.base_url') . '/planets';

        do {
            try {
                $response = Http::get($url)->json();
            } catch (Throwable $e) {
                $this->error('Failed to fetch Planets from SWAPI URL: ' . $url);
                Log::error('Failed to fetch Planets from SWAPI', [
                    'exception_message' => $e->getMessage(),
                    'exception_file' => $e->getFile(),
                    'exception_line' => $e->getLine(),
                    'url' => $url,
                    'command' => $this->getName(),
                ]);

                return self::FAILURE;
            }

            $url = $response['next'];

            foreach ($response['results'] as $inputPlanet) {
                $planetId = Str::of($inputPlanet['url'])->after(config('services.swapi.base_url') . '/planets/')->before('/')->toInteger();

                try {
                    $planet = Planet::updateOrCreate([
                        'id' => $planetId,
                        'name' => $inputPlanet['name'],
                    ],
                        [
                            'diameter' => (int) $inputPlanet['diameter'],
                            'rotation_period' => (int) $inputPlanet['rotation_period'],
                            'orbital_period' => (int) $inputPlanet['orbital_period'],
                            'gravity' => $inputPlanet['gravity'],
                            'population' => (int) $inputPlanet['population'],
                            'climate' => $inputPlanet['climate'],
                            'terrain' => $inputPlanet['terrain'],
                            'surface_water' => (int) $inputPlanet['surface_water'],
                        ]
                    );
                } catch (Throwable $e) {
                    $this->error('Failed to upsert Planet with ID ' . $planetId . ' - "' . $inputPlanet['name']);
                    Log::error('Failed to upsert Planet', [
                        'exception_message' => $e->getMessage(),
                        'exception_file' => $e->getFile(),
                        'exception_line' => $e->getLine(),
                        'command' => $this->getName(),
                    ]);

                    continue;
                }

                $this->line('Planet with ID ' . $planet->id . ' - "' . $planet->name . '" synced.');
                Log::info('Planet synced', [
                    'planet_id' => $planet->id,
                    'planet_name' => $planet->name,
                    'command' => $this->getName(),
                ]);
            }
        } while ($response['next'] !== null);

        // Residents


        $this->info('Planets & Residents sync completed.');
        Log::info('Planets & Residents sync completed', [
            'command' => $this->getName(),
        ]);

        return self::SUCCESS;
    }
}
