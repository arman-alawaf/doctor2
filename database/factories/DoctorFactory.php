<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialtyId = Specialty::inRandomOrder()->first()?->id;
        
        if (!$specialtyId) {
            // If no specialties exist, create one
            $specialtyId = Specialty::create([
                'name' => fake()->randomElement(['Cardiology', 'Dermatology', 'Neurology', 'Orthopedics', 'Pediatrics', 'General Medicine']),
                'description' => fake()->sentence(),
            ])->id;
        }

        return [
            'user_id' => User::factory()->state(['role' => 'Doctor']),
            'specialty_id' => $specialtyId,
            'license_number' => 'LIC-' . strtoupper(fake()->unique()->bothify('####-####-####')),
            'experience_years' => fake()->numberBetween(2, 30),
            'bio' => fake()->paragraph(3),
            'consultation_fee' => fake()->randomFloat(2, 50, 500),
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']), // Mostly active
        ];
    }

    /**
     * Indicate that the doctor is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the doctor is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }
}

