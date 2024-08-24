<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'name' => 'Alice Johnson',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Smith',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carol White',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
