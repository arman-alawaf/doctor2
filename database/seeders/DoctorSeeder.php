<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all specialties
        $specialties = Specialty::all();
        
        if ($specialties->isEmpty()) {
            $this->command->warn('No specialties found. Please run SpecialtySeeder first.');
            return;
        }

        // Demo doctors with specific data
        $demoDoctors = [
            [
                'user' => [
                    'name' => 'Dr. Sarah Johnson',
                    'email' => 'sarah.johnson@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0101',
                    'date_of_birth' => '1980-05-15',
                    'address' => '123 Medical Center Dr, Health City, HC 12345',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'Cardiology')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-CARD-2020-001',
                    'experience_years' => 15,
                    'bio' => 'Dr. Sarah Johnson is a board-certified cardiologist with over 15 years of experience in treating heart conditions. She specializes in preventive cardiology and interventional procedures.',
                    'consultation_fee' => 250.00,
                    'status' => 'active',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dr. Michael Chen',
                    'email' => 'michael.chen@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0102',
                    'date_of_birth' => '1978-08-22',
                    'address' => '456 Health Avenue, Medical District, MD 54321',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'Dermatology')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-DERM-2018-002',
                    'experience_years' => 12,
                    'bio' => 'Dr. Michael Chen is an experienced dermatologist specializing in skin cancer treatment, cosmetic dermatology, and pediatric dermatology.',
                    'consultation_fee' => 200.00,
                    'status' => 'active',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dr. Emily Rodriguez',
                    'email' => 'emily.rodriguez@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0103',
                    'date_of_birth' => '1985-03-10',
                    'address' => '789 Wellness Blvd, Care City, CC 67890',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'Pediatrics')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-PED-2021-003',
                    'experience_years' => 8,
                    'bio' => 'Dr. Emily Rodriguez is a dedicated pediatrician with a passion for children\'s health. She provides comprehensive care for infants, children, and adolescents.',
                    'consultation_fee' => 150.00,
                    'status' => 'active',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dr. James Wilson',
                    'email' => 'james.wilson@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0104',
                    'date_of_birth' => '1975-11-30',
                    'address' => '321 Medical Plaza, Health Town, HT 11223',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'Orthopedics')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-ORTH-2015-004',
                    'experience_years' => 20,
                    'bio' => 'Dr. James Wilson is a renowned orthopedic surgeon specializing in joint replacement, sports medicine, and trauma surgery.',
                    'consultation_fee' => 300.00,
                    'status' => 'active',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dr. Lisa Anderson',
                    'email' => 'lisa.anderson@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0105',
                    'date_of_birth' => '1982-07-18',
                    'address' => '654 Care Street, Wellness City, WC 44556',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'Neurology')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-NEUR-2019-005',
                    'experience_years' => 10,
                    'bio' => 'Dr. Lisa Anderson is a neurologist specializing in the diagnosis and treatment of neurological disorders, including epilepsy, stroke, and movement disorders.',
                    'consultation_fee' => 275.00,
                    'status' => 'active',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dr. Robert Taylor',
                    'email' => 'robert.taylor@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0106',
                    'date_of_birth' => '1979-12-05',
                    'address' => '987 Health Drive, Medical Center, MC 77889',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'General Medicine')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-GEN-2017-006',
                    'experience_years' => 14,
                    'bio' => 'Dr. Robert Taylor is a family medicine physician providing comprehensive primary care for patients of all ages, focusing on preventive medicine and chronic disease management.',
                    'consultation_fee' => 180.00,
                    'status' => 'active',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dr. Maria Garcia',
                    'email' => 'maria.garcia@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0107',
                    'date_of_birth' => '1983-04-25',
                    'address' => '147 Wellness Way, Care District, CD 33445',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'Psychiatry')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-PSYCH-2020-007',
                    'experience_years' => 9,
                    'bio' => 'Dr. Maria Garcia is a board-certified psychiatrist specializing in mood disorders, anxiety, and psychotherapy. She provides compassionate mental health care.',
                    'consultation_fee' => 220.00,
                    'status' => 'active',
                ],
            ],
            [
                'user' => [
                    'name' => 'Dr. David Brown',
                    'email' => 'david.brown@dms.com',
                    'password' => Hash::make('password'),
                    'role' => 'Doctor',
                    'phone' => '+1-555-0108',
                    'date_of_birth' => '1981-09-14',
                    'address' => '258 Medical Lane, Health Village, HV 55667',
                ],
                'doctor' => [
                    'specialty_id' => $specialties->where('name', 'Gynecology')->first()->id ?? $specialties->random()->id,
                    'license_number' => 'LIC-GYN-2018-008',
                    'experience_years' => 11,
                    'bio' => 'Dr. David Brown is an experienced gynecologist providing comprehensive women\'s health care, including routine exams, reproductive health, and gynecological surgery.',
                    'consultation_fee' => 240.00,
                    'status' => 'active',
                ],
            ],
        ];

        // Create demo doctors
        foreach ($demoDoctors as $demoDoctor) {
            $user = User::create($demoDoctor['user']);
            Doctor::create(array_merge($demoDoctor['doctor'], ['user_id' => $user->id]));
        }

        // Create additional random doctors using factory
        Doctor::factory()
            ->count(10)
            ->active()
            ->create();

        $this->command->info('Demo doctors created successfully!');
        $this->command->info('You can login with any doctor email (e.g., sarah.johnson@dms.com) and password: password');
    }
}

