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
}
