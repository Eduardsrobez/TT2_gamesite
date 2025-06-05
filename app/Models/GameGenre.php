<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameGenre extends Model
{
    use HasFactory;

    protected $table = 'game_genres';

    protected $fillable = [
        'game_id',
        'genre_id',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}

