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
        $this->call([
            SpecialtySeeder::class,
            DoctorSeeder::class,
            PostSeeder::class,
        ]);

        // Create an admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@dms.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'Admin',
            ]
        );
    }
}
