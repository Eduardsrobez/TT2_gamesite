<?php

namespace App\Http\Controllers;
use App\Services\AuditLogger;
use App\Models\Comment;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Game $game)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|between:1,5'
        ]);

        $comment = $game->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);

        // Log audit entry
        AuditLogger::log(
            'comment_created',
            "User ID " . Auth::id() . " posted comment ID {$comment->id} on game ID {$game->id} with rating {$request->rating}"
        );

        return back()->with('success', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        $commentId = $comment->id;
        $gameId = $comment->game_id;

        $comment->delete();

        AuditLogger::log(
            'Delete Comment',
            "User ID " . Auth::id() . " deleted comment ID {$commentId} on game ID {$gameId}"
        );

        return back()->with('success', 'Comment deleted successfully!');
    }
}
