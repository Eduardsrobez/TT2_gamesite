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
        }

        $query->latest('created_at');
        $games = $query->get();

        $genres = Genre::select('genres.*')
            ->selectSub(function ($query) {
                $query->from('game_genres')
                    ->whereColumn('game_genres.genre_id', 'genres.id')
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

    public function view(Game $game)
    {
        // Eager load relationships
        $game->load('user', 'genres');

        return view('games.details', compact('game'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('games.create', compact('genres'));
    }

    public function store(StoreGameRequest $request)
    {
        $path = $request->file('cover_image')->store('game_covers', 'public');

        $game = Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'game_link' => $request->game_link,
            'cover_image' => $path,
            'user_id' => auth()->id(),
            'submitted_on' => now(),
        ]);

        $game->genres()->attach($request->genres);

        return redirect()->route('gamelist.show', $game)->with('success', 'Game posted successfully!');
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
            $game->cover_image = $request->file('cover_image')->store('game_covers', 'public');
            $game->save();
        }

        $game->genres()->sync($validated['genres']);

        return redirect()->route('games.details', $game)->with('success', 'Game updated successfully.');
    }
}
