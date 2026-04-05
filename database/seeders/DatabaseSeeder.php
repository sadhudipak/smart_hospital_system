<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Pal akbari',
            'email' => 'admin@hospital.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Departments
        $departments = [
            ['name' => 'Cardiology', 'description' => 'Heart and cardiovascular system', 'icon' => 'fa-heart'],
            ['name' => 'Neurology', 'description' => 'Brain and nervous system', 'icon' => 'fa-brain'],
            ['name' => 'Orthopedics', 'description' => 'Bones and joints', 'icon' => 'fa-bone'],
            ['name' => 'Pediatrics', 'description' => 'Child healthcare', 'icon' => 'fa-baby'],
            ['name' => 'Dermatology', 'description' => 'Skin conditions', 'icon' => 'fa-allergies'],
            ['name' => 'General Medicine', 'description' => 'General health', 'icon' => 'fa-stethoscope'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }

        // Create Sample Doctors
        $doctors = [
            ['name' => 'Veerja Raijada', 'email' => 'dr.veerja@hospital.com', 'specialization' => 'Cardiologist', 'dept' => 1],
            ['name' => 'Dhruv Patel', 'email' => 'dr.dhruv@hospital.com', 'specialization' => 'Neurologist', 'dept' => 2],
            ['name' => 'Dipak Sadhu', 'email' => 'dr.dipak@hospital.com', 'specialization' => 'Orthopedic Surgeon', 'dept' => 3],
        ];

        foreach ($doctors as $doc) {
            $user = User::create([
                'name' => $doc['name'],
                'email' => $doc['email'],
                'password' => Hash::make('password'),
                'role' => 'doctor',
                'is_active' => true,
            ]);

            Doctor::create([
                'user_id' => $user->id,
                'department_id' => $doc['dept'],
                'specialization' => $doc['specialization'],
                'qualification' => 'MD, MBBS',
                'experience_years' => rand(5, 20),
                'consultation_fee' => rand(500, 2000),
                'bio' => 'Experienced specialist with excellent patient care.',
                'available_days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'available_from' => '09:00',
                'available_to' => '17:00',
            ]);
        }

        // Create Sample Patient
        User::create([
            'name' => 'Aditya Sirja',
            'email' => 'aditya@gmail.com',
            'password' => Hash::make('aditya123'),
            'role' => 'patient',
            'phone' => '1234567890',
            'gender' => 'male',
            'date_of_birth' => '2026-04-02',
            'is_active' => true,
        ]);
    }
}
