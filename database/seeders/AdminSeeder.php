<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\{DB, Hash, Schema};
use Illuminate\Database\Seeder;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('admins')->insert([
            'email' => 'admin1@example.com',
            'name' => 'Pahlevi',
            'password' => Hash::make('adminexample123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema:: dropIfExists('admins');
    }
}
