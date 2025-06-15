<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuditLogger;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

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
        $oldRole = $user->role;

        $user->update(['role' => $validated['role']]);
        AuditLogger::log(
            'role_updated',
            "User ID {$currentUser->id} changed role of User ID {$user->id} from {$oldRole} to {$validated['role']}"
        );
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
        $deletedUserId = $user->id;
        $deletedUserRole = $user->role;
        $deletedUserName = $user->name;
        $user->delete();
        AuditLogger::log(
            'user_deleted',
            "User ID {$currentUser->id} deleted user ID {$deletedUserId} ({$deletedUserName}) with role {$deletedUserRole}"
        );
        return back()->with('success', 'User deleted successfully');
    }
    public function exportAuditLogs()
    {
        $logs = AuditLog::orderBy('created_at', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="audit_logs.txt"',
        ];

        $callback = function () use ($logs) {
            $handle = fopen('php://output', 'w');

            foreach ($logs as $log) {
                $line = "ID: {$log->id} | User ID: {$log->user_id} | Action: {$log->action} | Description: {$log->description} | IP: {$log->ip_address} | Created At: {$log->created_at}\n";
                fwrite($handle, $line);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}
