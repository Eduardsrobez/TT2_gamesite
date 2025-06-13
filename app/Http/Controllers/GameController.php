<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Genre;
use App\Models\GameGenre;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGameRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
class GameController extends Controller
{
    public function show(Request $request)
    {
        $query = Game::with('genres');

        if ($request->has('unapproved')) {
            $query->where('admin_approved', false);
        } else $query->where('admin_approved', true);

        if ($request->has('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }

        if ($sort = $request->input('sort')) {
            switch ($sort) {
                case 'title_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'title_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'rating':
                    $query->withAvg('comments', 'rating')
                        ->orderByDesc('comments_avg_rating');
                    break;
                default:
                    $query->latest('created_at');
            }
        } else $query->latest('created_at');

        $games = $query->get();

        $genres = Genre::select('genres.*')
            ->selectSub(function ($query) {
                $query->from('game_genres')
                    ->join('games', 'game_genres.game_id', '=', 'games.id')
                    ->whereColumn('game_genres.genre_id', 'genres.id')
                    ->where('games.admin_approved', true)  // Only count approved games
                    ->selectRaw('COUNT(*)');
            }, 'games_count')
            ->get();

        return view('gamelist', [
            'games' => $games,
            'genres' => $genres,
            'currentGenre' => $request->genre,
            'currentSort' => $request->sort,
            'currentSearch' => $request->search
        ]);
    }

    public function approve(Game $game)
    {
        $game->update(['admin_approved' => true]);
        return back()->with('success', 'Game approved successfully!');
    }

    public function view(Game $game)
    {
        // Eager load relationships
        $game->load(['genres', 'comments.user']);
        return view('games.details', compact('game'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('games.create', compact('genres'));
    }

    public function store(StoreGameRequest $request)
    {
        $user = auth()->user();

        $path = $request->hasFile('cover_image')
            ? $request->file('cover_image')->store('game_covers', 'public')
            : null;

        $game = Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'game_link' => $request->game_link,
            'cover_image' => $path,
            'user_id' => $user->id,
            'submitted_on' => now(),
            'admin_approved' => $user->isAdmin(),
        ]);

        $game->genres()->attach($request->genres);
        if ($user->isAdmin()) {
            return redirect()->route('gamelist.show', $game)->with('success', 'Game posted successfully!');
        }
        else {
            return redirect()->route('gamelist.show', $game)->with('success', 'Game posted, waiting for approval!');
        }
    }

    public function edit(Game $game)
    {
        $genres = Genre::all();
        return view('games.edit', compact('game', 'genres'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'game_link' => 'required|url',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $game->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'game_link' => $validated['game_link'],
        ]);

        if ($request->hasFile('cover_image')) {
            if ($game->cover_image && Storage::disk('public')->exists($game->cover_image)) {
                Storage::disk('public')->delete($game->cover_image);
            }
            $game->cover_image = $request->file('cover_image')->store('game_covers', 'public');
            $game->save();
        }

        $game->genres()->sync($validated['genres']);

        return redirect()->route('games.details', $game)->with('success', 'Game updated successfully.');
    }

    public function destroy(Game $game)
    {
        if ($game->cover_image && \Storage::disk('public')->exists($game->cover_image)) {
            \Storage::disk('public')->delete($game->cover_image);
        }

        $game->delete();

        return redirect()->route('gamelist.show')->with('success', 'Game post deleted successfully!');
    }

}
