<?php

namespace Database\Seeders;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'comment' => 'Awesome game!',
            'rating' => 5,
            'user_id' => 3, // Regular User
            'game_id' => 1,
        ]);

        Comment::create([
            'comment' => 'Needs improvement, but a solid start.',
            'rating' => 3,
            'user_id' => 3,
            'game_id' => 2,
        ]);
    }
}
