<?php

namespace App\Http\Controllers;

use App\Models\TesterReview;
use App\Models\Game;
use Illuminate\Http\Request;

class TesterReviewController extends Controller
{
    public function store(Request $request, Game $game)
    {
        // Check if the user is a tester
        if (!auth()->user()->isTester() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        // Validate incoming data
        $validated = $request->validate([
            'review' => 'required|string|max:2000',
            'bugs_found' => 'nullable|string|max:2000',
        ]);

        // Create the review
        $game->testerReviews()->create([
            'user_id' => auth()->id(),
            'review' => $validated['review'],
            'bugs_found' => $validated['bugs_found'],
        ]);

        return redirect()->back()->with('success', 'Tester review submitted successfully!');
    }
    public function destroy(TesterReview $testerReview)
    {
        // Only owner or admin can delete
        if (!auth()->user()->isTester() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $testerReview->delete();

        return back()->with('success', 'Tester review deleted.');
    }
}
