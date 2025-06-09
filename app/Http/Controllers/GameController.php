<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;

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
}
