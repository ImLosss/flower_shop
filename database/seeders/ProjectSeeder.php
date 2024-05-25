<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'name' => 'projek1',
            'user_id' => mt_rand(1, 20),
        ]);

        Project::create([
            'name' => 'projek2',
            'user_id' => mt_rand(1, 20),
        ]);

        Project::create([
            'name' => 'projek3',
            'user_id' => mt_rand(1, 20),
        ]);
    }
}
