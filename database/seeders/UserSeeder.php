<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'superAdmin',
            'email' => 'admin@gmail.com',
            'notelp' => '082192598451',
            'alamat' => 'Polewali',
            'password' => Hash::make('password')
        ])->assignRole('admin');

        User::create([
            'name' => 'Losss',
            'email' => 'user@gmail.com',
            'notelp' => '082192598451',
            'alamat' => 'Manding',
            'password' => Hash::make('password')
        ])->assignRole('member');

        User::create([
            'name' => 'Ryan',
            'email' => 'user1@gmail.com',
            'notelp' => '082192598451',
            'alamat' => 'Manding',
            'password' => Hash::make('password')
        ])->assignRole('member');

        User::factory(8)->create();
    }
}
