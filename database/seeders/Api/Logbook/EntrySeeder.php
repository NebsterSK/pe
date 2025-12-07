<?php

namespace Database\Seeders\Api\Logbook;

use App\Models\Api\Logbook\Entry;
use Illuminate\Database\Seeder;

class EntrySeeder extends Seeder
{
    public function run(): void
    {
        Entry::factory()->count(10)->create();
    }
}
