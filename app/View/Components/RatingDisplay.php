<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RatingDisplay extends Component
{
    public $game;
    public $averageRating;
    public $ratingCount;

    public function __construct($game)
    {
        $this->game = $game;
        $this->averageRating = $game->comments()->avg('rating');
        $this->ratingCount = $game->comments()->count();
    }

    public function render()
    {
        return view('components.rating-display');
    }
}
