<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TesterReviewController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('gamelist.show');
    }
    return view('welcome');
});


Route::middleware(['auth', 'can:create,App\Models\Game'])->group(function () {
    Route::get('/gamelist/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/gamelist', [GameController::class, 'store'])->name('games.store');
});
Route::middleware(['auth', 'can:viewAdminDashboard,App\Models\User'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::put('/admin/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/gamelist', [GameController::class, 'show'])->name('gamelist.show');

    Route::get('/gamelist/{game}', [GameController::class, 'view'])->name('games.details');

    Route::patch('/games/{game}/approve', [GameController::class, 'approve'])->middleware('can:approve,game')->name('games.approve');

    Route::get('/gamelist/{game}/edit', [GameController::class, 'edit'])->middleware('can:update,game')->name('games.edit');
    Route::put('/gamelist/{game}', [GameController::class, 'update'])->middleware('can:update,game')->name('games.update');

    Route::delete('/gamelist/{game}', [GameController::class, 'destroy'])->middleware('can:destroy,game')->name('games.destroy');

    Route::post('/games/{game}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/gamelist/{game}/tester-reviews', [TesterReviewController::class, 'store'])->name('tester-reviews.store');
    Route::delete('/tester-reviews/{testerReview}', [TesterReviewController::class, 'destroy'])->name('tester-reviews.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
