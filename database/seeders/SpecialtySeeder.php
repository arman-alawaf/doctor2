<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => 'Cardiology', 'description' => 'Heart and cardiovascular system'],
            ['name' => 'Dermatology', 'description' => 'Skin, hair, and nails'],
            ['name' => 'Neurology', 'description' => 'Brain and nervous system'],
            ['name' => 'Orthopedics', 'description' => 'Bones, joints, and muscles'],
            ['name' => 'Pediatrics', 'description' => 'Children and adolescents'],
            ['name' => 'Psychiatry', 'description' => 'Mental health and disorders'],
            ['name' => 'General Medicine', 'description' => 'General health and wellness'],
            ['name' => 'Gynecology', 'description' => 'Women\'s reproductive health'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
