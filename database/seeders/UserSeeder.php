<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'no_wa' => '05158980056',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $dokter = User::create([
            'name' => 'user',
            'username' => 'user',
            'no_wa' => '05158980057',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);
        $dokter->assignRole('user');
    }
}
