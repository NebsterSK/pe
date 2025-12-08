<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class SyncCommand extends Command
{
    /**
     * Ak by podla zadania zoznam planet a rezidentov bol v milionoch, pouzil by som ?perPage s hodnotu 1 000 - 10 000 a upsert threshold s hodnotou 10 000 - 50 000.
     */
    public const int UPSERT_THRESHOLD = 10;

    protected $signature = 'sync';
    protected $description = 'Sync data of all Planets and Residents from SWAPI to local database.';

    protected int $planetsSynced = 0;
    protected int $residentsSynced = 0;

    public function handle(): int
    {
        $this->info('Planets & Residents sync started.');
        Log::info('Planets & Residents sync started', [
            'command' => $this->getName(),
        ]);

        // Planets
        $baseUrl = config('services.swapi.base_url').'/planets';
        $page = 1;

        $data = [];
        $dataCount = 0;

        do {
            $url = $baseUrl.'?page='.$page;

            try {
                $response = Http::acceptJson()->get($url);
            } catch (Throwable $e) {
                $this->error('Failed to fetch Planets from URL: '.$url);
                Log::error('Failed to fetch Planets', [
                    'exception_message' => $e->getMessage(),
                    'exception_file' => $e->getFile(),
                    'exception_line' => $e->getLine(),
                    'url' => $url,
                    'command' => $this->getName(),
                ]);

                $page++;

                continue;
            }

            $page++;

            foreach ($response->json()['results'] ?? [] as $planetData) {
                $data[] = $this->preparePlanetData($planetData);
                $dataCount++;
                $this->planetsSynced++;

                // Upsert data by threshold
                if ($dataCount >= self::UPSERT_THRESHOLD) {
                    try {
                        $this->upsertPlanetData($data);
                    } catch (Throwable $e) {
                        $this->error('Failed to sync Planets');
                        Log::error('Failed to sync Planets', [
                            'exception_message' => $e->getMessage(),
                            'exception_file' => $e->getFile(),
                            'exception_line' => $e->getLine(),
                            'command' => $this->getName(),
                        ]);

                        continue;
                    }

                    $this->line('Planets synced: '.$dataCount);
                    Log::info('Planets synced', [
                        'count' => $dataCount,
                        'command' => $this->getName(),
                    ]);

                    $data = [];
                    $dataCount = 0;
                }
            }
        } while ($response->status() !== Response::HTTP_NOT_FOUND);

        // Upsert remaining data that didn't reach the threshold
        if ($dataCount > 0) {
            try {
                $this->upsertPlanetData($data);
            } catch (Throwable $e) {
                $this->error('Failed to sync Planets');
                Log::error('Failed to sync Planets', [
                    'exception_message' => $e->getMessage(),
                    'exception_file' => $e->getFile(),
                    'exception_line' => $e->getLine(),
                    'command' => $this->getName(),
                ]);
            }

            $this->line('Planets synced: '.$dataCount);
            Log::info('Planets synced', [
                'count' => $dataCount,
                'command' => $this->getName(),
            ]);
        }

        // Residents
        $baseUrl = config('services.swapi.base_url').'/people';
        $page = 1;

        $data = [];
        $dataCount = 0;

        do {
            $url = $baseUrl.'?page='.$page;

            try {
                $response = Http::acceptJson()->get($url);
            } catch (Throwable $e) {
                $this->error('Failed to fetch Residents from URL: '.$url);
                Log::error('Failed to fetch Residents', [
                    'exception_message' => $e->getMessage(),
                    'exception_file' => $e->getFile(),
                    'exception_line' => $e->getLine(),
                    'url' => $url,
                    'command' => $this->getName(),
                ]);

                $page++;

                continue;
            }

            $page++;

            foreach ($response->json()['results'] ?? [] as $residentData) {
                $data[] = $this->prepareResidentData($residentData);
                $dataCount++;
                $this->residentsSynced++;

                // Upsert data by threshold
                if ($dataCount >= self::UPSERT_THRESHOLD) {
                    try {
                        $this->upsertResidentData($data);
                    } catch (Throwable $e) {
                        $this->error('Failed to sync Residents');
                        Log::error('Failed to sync Residents', [
                            'exception_message' => $e->getMessage(),
                            'exception_file' => $e->getFile(),
                            'exception_line' => $e->getLine(),
                            'command' => $this->getName(),
                        ]);

                        continue;
                    }

                    $this->line('Residents synced: '.$dataCount);
                    Log::info('Residents synced', [
                        'count' => $dataCount,
                        'command' => $this->getName(),
                    ]);

                    $data = [];
                    $dataCount = 0;
                }
            }
        } while ($response->status() !== Response::HTTP_NOT_FOUND);

        // Upsert remaining data that didn't reach the threshold
        if ($dataCount > 0) {
            try {
                $this->upsertResidentData($data);
            } catch (Throwable $e) {
                $this->error('Failed to sync Residents');
                Log::error('Failed to sync Residents', [
                    'exception_message' => $e->getMessage(),
                    'exception_file' => $e->getFile(),
                    'exception_line' => $e->getLine(),
                    'command' => $this->getName(),
                ]);
            }

            $this->line('Residents synced: '.$dataCount);
            Log::info('Residents synced', [
                'count' => $dataCount,
                'command' => $this->getName(),
            ]);
        }

        $this->info('Planets & Residents sync completed.');
        Log::info('Planets & Residents sync completed', [
            'planets_count' => $this->planetsSynced,
            'residents_count' => $this->residentsSynced,
            'command' => $this->getName(),
        ]);

        return self::SUCCESS;
    }

    protected function preparePlanetData(array $data): array
    {
        return [
            'id' => Str::of($data['url'])->after(config('services.swapi.base_url').'/planets/')->before('/')->toInteger(),
            'name' => $data['name'],
            'diameter' => (int) $data['diameter'],
            'rotation_period' => (int) $data['rotation_period'],
            'orbital_period' => (int) $data['orbital_period'],
            'gravity' => $data['gravity'],
            'population' => (int) $data['population'],
            'climate' => $data['climate'],
            'terrain' => $data['terrain'],
            'surface_water' => (int) $data['surface_water'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    protected function upsertPlanetData(array $data): void
    {
        DB::table('planets')->upsert(
            $data,
            [
                'id',
            ],
            [
                'name',
                'diameter',
                'rotation_period',
                'orbital_period',
                'gravity',
                'population',
                'climate',
                'terrain',
                'surface_water',
                'updated_at',
            ],
        );
    }

    protected function prepareResidentData(array $data): array
    {
        return [
            'id' => Str::of($data['url'])->after(config('services.swapi.base_url').'/people/')->before('/')->toInteger(),
            'name' => $data['name'],
            'birth_year' => $data['birth_year'],
            'eye_color' => $data['eye_color'],
            'gender' => $data['gender'],
            'hair_color' => $data['hair_color'],
            'height' => (int) $data['height'],
            'mass' => (int) $data['mass'],
            'skin_color' => $data['skin_color'],
            'planet_id' => Str::of($data['homeworld'])->after(config('services.swapi.base_url').'/planets/')->before('/')->toInteger(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    protected function upsertResidentData(array $data): void
    {
        DB::table('residents')->upsert(
            $data,
            [
                'id',
            ],
            [
                'name',
                'birth_year',
                'eye_color',
                'gender',
                'hair_color',
                'height',
                'mass',
                'skin_color',
                'planet_id',
                'updated_at',
            ],
        );
    }
}
