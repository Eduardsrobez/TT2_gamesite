<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAdminDashboard(User $user)
    {
        return $user->isRoot() || $user->isAdmin();
    }

    public function updateRole(User $admin, User $targetUser)
    {
        // Root can do anything
        if ($admin->isRoot()) return true;

        // Admins can only modify non-admins and non-roots
        return $admin->isAdmin() &&
            !$targetUser->isRoot() &&
            !$targetUser->isAdmin();
    }

    public function delete(User $admin, User $targetUser)
    {
        // Cannot delete yourself
        if ($admin->id === $targetUser->id) return false;

        // Root can delete anyone except other roots
        if ($admin->isRoot()) return !$targetUser->isRoot();

        // Admins can only delete non-admins
        return $admin->isAdmin() && !$targetUser->isAdmin();
    }
}
