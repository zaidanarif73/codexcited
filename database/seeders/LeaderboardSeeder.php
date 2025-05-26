<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Leaderboard;

class LeaderboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leaderboard::create([
            'user_id' => 3,
            'score' => 800,
        ]);

        Leaderboard::create([
            'user_id' => 4,
            'score' => 1000,
        ]);
    }
}
