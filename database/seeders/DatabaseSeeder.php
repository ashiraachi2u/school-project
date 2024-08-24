<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\Student;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::truncate();  // Deletes all users
        Teacher::truncate();  // Deletes all teachers
        Student::truncate();  // Deletes all students
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com'
        ]);

        // Seed the teachers table
        $this->call(TeachersTableSeeder::class);

        // Seed the students table
        $this->call(StudentsTableSeeder::class);
    }
}
