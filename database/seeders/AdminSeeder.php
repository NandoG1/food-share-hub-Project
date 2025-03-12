<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@binus.ac.id',
        ], [
            'name' => 'Admin',
            'email' => 'admin@binus.ac.id',
            'role' => 'admin',
            'password' => bcrypt('admin')
        ]);
    }
}
