<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\Genre;
use App\Models\User;
use App\Models\Game;
use App\Models\Comment;
use App\Models\TesterReview;
use App\Models\GameGenre;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            GamesTableSeeder::class,
            CommentsTableSeeder::class,
            TesterReviewsTableSeeder::class,
            GenresTableSeeder::class,
            GameGenresTableSeeder::class,
        ]);

    }
}
