<?php

namespace Database\Seeders;

use App\Models\detail_team;
use App\Models\DetailTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 21; $i++) { 
            DetailTeam::create([
                'user_id' => $i,
                'project_id' => mt_rand(1,3),
            ]);
        }
    }
}
