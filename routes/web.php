<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'can:create,App\Models\Game'])->group(function () {
    Route::get('/gamelist/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/gamelist', [GameController::class, 'store'])->name('games.store');
    Route::patch('/games/{game}/approve', [GameController::class, 'approve'])->name('games.approve');
});
Route::middleware('auth')->group(function () {
    Route::get('/gamelist', [GameController::class, 'show'])->name('gamelist.show');
    Route::get('/gamelist/{game}', [GameController::class, 'view'])->name('games.details');
    Route::get('/gamelist/{game}/edit', [GameController::class, 'edit'])->middleware('can:update,game')->name('games.edit');
    Route::put('/gamelist/{game}', [GameController::class, 'update'])->middleware('can:update,game')->name('games.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
