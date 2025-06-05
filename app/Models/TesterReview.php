<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesterReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'review',
        'bugs_found',
        'user_id',
        'game_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

