<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@adron.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
            ]
        );

        $this->call([
            SettingSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
