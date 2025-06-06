<?php

namespace Database\Seeders;
use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
            'name' => 'Space Battle',
            'game_link' => 'http://example.com/spacebattle',
            'submitted_on' => now(),
            'admin_approved' => true,
            'cover_image' => 'spacebattle.jpg',
            'user_id' => 1, // Admin User
        ]);

        Game::create([
            'name' => 'Jungle Run',
            'game_link' => 'http://example.com/junglerun',
            'submitted_on' => now(),
            'admin_approved' => false,
            'cover_image' => 'junglerun.jpg',
            'user_id' => 2, // Dev User
        ]);

        Game::create([
            'name' => 'Craft Mine',
            'game_link' => 'http://example.com/craftmine',
            'submitted_on' => now(),
            'admin_approved' => false,
            'cover_image' => 'craftmine',
            'user_id' => 2, // Dev User
        ]);
    }
}
