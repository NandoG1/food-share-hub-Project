<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate([
            'email' => 'admin1@binus.ac.id',
        ], [
            'name' => 'Admin1',
            'email' => 'admin1@binus.ac.id',
            'role' => 'admin',
            'password' => bcrypt('admin')
        ]);

        Admin::updateOrCreate([
            'email' => 'admin2@gmail.com'
        ], [
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'role' =>   'admin',
            'password' => bcrypt('admin')
        ]);
    }
}