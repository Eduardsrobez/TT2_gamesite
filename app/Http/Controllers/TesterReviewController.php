<?php

namespace App\Http\Controllers;

use App\Models\TesterReview;
use App\Models\Game;
use App\Services\AuditLogger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TesterReviewController extends Controller
{
    public function store(Request $request, Game $game)
    {
        // Check if the user is a tester or admin
        if (!auth()->user()->isTester() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Validate incoming data
        $validated = $request->validate([
            'review' => 'required|string|max:2000',
            'bugs_found' => 'nullable|string|max:2000',
        ]);

        // Create the review
        $review = $game->testerReviews()->create([
            'user_id' => auth()->id(),
            'review' => $validated['review'],
            'bugs_found' => $validated['bugs_found'],
        ]);

        // Log the tester review submission
        AuditLogger::log(
            'Submit Tester Review',
            "User ID " . Auth::id() . " submitted a review ID {$review->id} for game ID {$game->id}"
        );

        return redirect()->back()->with('success', 'Tester review submitted successfully!');
    }
    public function destroy(TesterReview $testerReview)
    {
        // Only owner or admin can delete
        if (!auth()->user()->isTester() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $reviewId = $testerReview->id;
        $gameId = $testerReview->game_id;

        $testerReview->delete();

        AuditLogger::log(
            'Delete Tester Review',
            "User ID " . Auth::id() . " deleted tester review ID {$reviewId} for game ID {$gameId}"
        );

        return back()->with('success', 'Tester review deleted.');
    }
}
