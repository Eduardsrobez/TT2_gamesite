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
        $games = Game::with('genres')
            ->when($request->genre, function ($query, $genreId) {
                $query->whereHas('genres', fn($q) => $q->where('id', $genreId));
            })
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
            ->when($request->sort === 'title', function ($query) {
                $query->orderBy('name');
            })
            ->get();

        return view('gamelist', [
            'games' => $games,
            'genres' => Genre::all(),
            'currentGenre' => $request->genre
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
}
