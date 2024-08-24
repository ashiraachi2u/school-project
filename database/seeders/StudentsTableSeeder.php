<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('students')->insert([
            [
                'student_name' => 'John Doe',
                'class_teacher_id' => 1, // Ensure this ID exists in teachers table
                'class' => '5th Grade',
                'admission_date' => '2023-09-01',
                'yearly_fees' => 5000.00,
            ],
            [
                'student_name' => 'Jane Smith',
                'class_teacher_id' => 2, // Ensure this ID exists in teachers table
                'class' => '6th Grade',
                'admission_date' => '2023-09-01',
                'yearly_fees' => 5500.00,
            ],
        ]);
    }
}
