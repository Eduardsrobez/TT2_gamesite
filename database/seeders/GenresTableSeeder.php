<?php

namespace Database\Seeders;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::firstOrCreate(['name' => 'Action']);
        Genre::firstOrCreate(['name' => 'Adventure']);
        Genre::firstOrCreate(['name' => 'Role-Playing']);
        Genre::firstOrCreate(['name' => 'Shooter']);
        Genre::firstOrCreate(['name' => 'Platformer']);
        Genre::firstOrCreate(['name' => 'Puzzle']);
        Genre::firstOrCreate(['name' => 'Strategy']);
        Genre::firstOrCreate(['name' => 'Simulation']);
        Genre::firstOrCreate(['name' => 'Horror']);
        Genre::firstOrCreate(['name' => 'Fighting']);
        Genre::firstOrCreate(['name' => 'Racing']);
        Genre::firstOrCreate(['name' => 'Sports']);
        Genre::firstOrCreate(['name' => 'Survival']);
        Genre::firstOrCreate(['name' => 'Sandbox']);
        Genre::firstOrCreate(['name' => 'Open World']);;
        Genre::firstOrCreate(['name' => 'Story']);
        Genre::firstOrCreate(['name' => 'Rhythm']);
        Genre::firstOrCreate(['name' => 'Roguelike']);;
        Genre::firstOrCreate(['name' => 'First-Person-Shooter']);
    }
}
