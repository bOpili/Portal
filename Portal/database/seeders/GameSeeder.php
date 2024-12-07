<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create(['title' => 'Digital Combat Simulator: World','type' => 'military']);
        Game::create(['title' => 'Il-2 Sturmovik: Great Battles','type' => 'military']);
        Game::create(['title' => 'Il-2 Sturmovik: 1946','type' => 'military']);
        Game::create(['title' => 'Microsoft Flight Simulator 2024','type' => 'civilian']);
        Game::create(['title' => 'Microsoft Flight Simulator 2020','type' => 'civilian']);
        Game::create(['title' => 'X-Plane 12','type' => 'civilian']);
        Game::create(['title' => 'X-Plane 11','type' => 'civilian']);
    }
}
