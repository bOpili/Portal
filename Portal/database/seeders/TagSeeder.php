<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name' => 'PvP']);
        Tag::create(['name' => 'PvE']);
        Tag::create(['name' => 'PvPvE']);
        Tag::create(['name' => 'Trening']);
        Tag::create(['name' => 'Operacja']);
        Tag::create(['name' => 'Eskadra']);
        Tag::create(['name' => 'Noob friendly']);
        Tag::create(['name' => 'Advanced']);
        Tag::create(['name' => 'Ace']);
    }
}
