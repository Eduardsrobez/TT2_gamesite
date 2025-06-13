<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'game_link',
        'submitted_on',
        'admin_approved',
        'cover_image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->with('user')->latest();
    }

    public function testerReviews()
    {
        return $this->hasMany(TesterReview::class);
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'game_genres', 'game_id', 'genre_id');
    }
}
