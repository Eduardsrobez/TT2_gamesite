<?php

namespace Database\Seeders;
use App\Models\GameGenre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameGenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GameGenre::create([
            'game_id' => 1,
            'genre_id' => 1,
        ]);
        GameGenre::create([
            'game_id' => 1,
            'genre_id' => 4,
        ]);
        GameGenre::create([
            'game_id' => 1,
            'genre_id' => 13,
        ]);
        GameGenre::create([
            'game_id' => 2,
            'genre_id' => 1,
        ]);
        GameGenre::create([
            'game_id' => 2,
            'genre_id' => 2,
        ]);
        GameGenre::create([
            'game_id' => 2,
            'genre_id' => 9,
        ]);
        GameGenre::create([
            'game_id' => 3,
            'genre_id' => 15,
        ]);
        GameGenre::create([
            'game_id' => 3,
            'genre_id' => 14,
        ]);
        GameGenre::create([
            'game_id' => 3,
            'genre_id' => 13,
        ]);
    }
}
