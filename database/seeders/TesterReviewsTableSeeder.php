<?php

namespace Database\Seeders;
use App\Models\TesterReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TesterReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TesterReview::create([
            'review' => 'Smooth mechanics but minor bugs found.',
            'bugs_found' => 'Enemy AI glitches occasionally in level 3',
            'user_id' => 3, // Tester User
            'game_id' => 1,
        ]);

        TesterReview::create([
            'review' => 'Laggy controls.',
            'bugs_found' => 'Severe Input lag on mobile',
            'user_id' => 3,
            'game_id' => 3,
        ]);
    }
}
