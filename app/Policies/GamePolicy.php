<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GamePolicy
{
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isDeveloper();
    }
    public function update(User $user, Game $game)
    {
        return $user->id === $game->user_id || $user->isAdmin();
    }
    public function approve(User $user, Game $game)
    {
        return $user->isAdmin();
    }
    public function destroy(User $user, Game $game){
        return $user->id === $game->user_id || $user->isAdmin();
    }
}
