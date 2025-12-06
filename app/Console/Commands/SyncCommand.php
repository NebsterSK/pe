<?php

namespace App\Console\Commands;

use App\Models\Planet;
use App\Models\Resident;
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
                $response = Http::acceptJson()->get($url)->json();
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

            foreach ($response['results'] as $planetData) {
                $planetId = Str::of($planetData['url'])->after(config('services.swapi.base_url') . '/planets/')->before('/')->toInteger();

                try {
                    $planet = $this->upsertPlanet($planetId, $planetData);
                } catch (Throwable $e) {
                    $this->error('Failed to upsert Planet with ID ' . $planetId . ' - "' . $planetData['name']);
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

        $this->info('Planets synced.');
        $this->info('Syncing Residents...');

        // Residents
        $url = config('services.swapi.base_url') . '/people';

        do {
            try {
                $response = Http::acceptJson()->get($url)->json();
            } catch (Throwable $e) {
                $this->error('Failed to fetch Residents from SWAPI URL: ' . $url);
                Log::error('Failed to fetch Residents from SWAPI', [
                    'exception_message' => $e->getMessage(),
                    'exception_file' => $e->getFile(),
                    'exception_line' => $e->getLine(),
                    'url' => $url,
                    'command' => $this->getName(),
                ]);

                return self::FAILURE;
            }

            $url = $response['next'];

            foreach ($response['results'] as $residentData) {
                $residentId = Str::of($residentData['url'])->after(config('services.swapi.base_url') . '/people/')->before('/')->toInteger();

                try {
                    $resident = $this->upsertResident($residentId, $residentData);
                } catch (Throwable $e) {
                    $this->error('Failed to upsert Resident with ID ' . $residentId . ' - "' . $residentData['name']);
                    Log::error('Failed to upsert Resident', [
                        'exception_message' => $e->getMessage(),
                        'exception_file' => $e->getFile(),
                        'exception_line' => $e->getLine(),
                        'command' => $this->getName(),
                    ]);

                    continue;
                }

                $this->line('Resident with ID ' . $resident->id . ' - "' . $resident->name . '" synced.');
                Log::info('Resident synced', [
                    'planet_id' => $resident->id,
                    'planet_name' => $resident->name,
                    'command' => $this->getName(),
                ]);
            }
        } while ($response['next'] !== null);

        $this->info('Planets & Residents sync completed.');
        Log::info('Planets & Residents sync completed', [
            'command' => $this->getName(),
        ]);

        return self::SUCCESS;
    }

    protected function upsertPlanet(int $planetId, array $data): Planet
    {
        return Planet::updateOrCreate(
            [
                'id' => $planetId,
                'name' => $data['name'],
            ],
            [
                'diameter' => (int) $data['diameter'],
                'rotation_period' => (int) $data['rotation_period'],
                'orbital_period' => (int) $data['orbital_period'],
                'gravity' => $data['gravity'],
                'population' => (int) $data['population'],
                'climate' => $data['climate'],
                'terrain' => $data['terrain'],
                'surface_water' => (int) $data['surface_water'],
            ]
        );
    }

    protected function upsertResident(int $residentId, array $data): Resident
    {
        return Resident::updateOrCreate(
            [
                'id' => $residentId,
            ],
            [
                'name' => $data['name'],
                'birth_year' => $data['birth_year'],
                'eye_color' => $data['eye_color'],
                'gender' => $data['gender'],
                'hair_color' => $data['hair_color'],
                'height' => (int) $data['height'],
                'mass' => (int) $data['mass'],
                'skin_color' => $data['skin_color'],
                'planet_id' => Str::of($data['homeworld'])->after(config('services.swapi.base_url') . '/planets/')->before('/')->toInteger(),
            ]
        );
    }
}
