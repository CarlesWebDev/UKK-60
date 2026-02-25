<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Hash, Schema};

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('students')->insert([
            'nisn' => '12345678910',
            'name' => 'ahmad baijuri',
            'grade' => 'X',
            'password' => Hash::make('studentexample123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
}
