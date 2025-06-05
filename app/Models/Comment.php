<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Table name (optional if matches 'comments')
    protected $table = 'comments';

    // Fields that can be mass assigned
    protected $fillable = [
        'comment',
        'rating',
        'user_id',
        'game_id',
    ];

    /**
     * Relationship: Comment belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Comment belongs to a game
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

