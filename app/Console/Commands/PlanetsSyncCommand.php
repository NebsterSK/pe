<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PlanetsSyncCommand extends Command
{
    protected $signature = 'planets:sync';

    protected $description = 'Sync data of all planets and residents from SWAPI to local database.';

    public function handle(): int
    {


        return self::SUCCESS;
    }
}
