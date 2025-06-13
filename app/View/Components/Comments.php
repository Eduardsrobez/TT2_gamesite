<?php

namespace App\View\Components;

use App\Models\Game;
use Illuminate\View\Component;

class Comments extends Component
{
    public $game;
    public $comments;

    public function __construct(Game $game)
    {
        $this->game = $game;
        $this->comments = $game->comments;
    }

    public function render()
    {
        return view('components.comments');
    }
}
