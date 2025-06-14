<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Game;

class TesterReviews extends Component
{
    public Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function render(): View|Closure|string
    {
        return view('components.tester-reviews');
    }
}
