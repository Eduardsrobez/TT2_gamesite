<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::whereNotIn('role', ['root'])->get();
        return view('admin.dashboard', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $currentUser = Auth::user();

        $validated = $request->validate([
            'role' => 'required|in:admin,Game-Developer,tester,user'
        ]);

        if (
            $currentUser->role !== 'root' &&
            (
                $user->role === 'admin' || $validated['role'] === 'admin'
            )
        ) {
            abort(403, 'Unauthorized action.');
        }

        $user->update(['role' => $validated['role']]);

        return back()->with('success', 'Role updated successfully');
    }


    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        // Only root can delete admins or other users
        if (
            $currentUser->role !== 'root' &&
            ($user->role === 'admin' || $user->role === 'root')
        ) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}
