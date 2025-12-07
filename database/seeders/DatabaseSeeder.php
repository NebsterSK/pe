<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            // Password: password
        ]);

        DB::table('personal_access_tokens')->insert([
            'tokenable_type' => User::class,
            'tokenable_id' => $admin->id,
            'name' => 'test',
            'token' => 'f2d05d1d5b6f4c84373c413071fe0265bf571d1810f1da8b711de3389be3d7cc',
            'abilities' => '["*"]',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
