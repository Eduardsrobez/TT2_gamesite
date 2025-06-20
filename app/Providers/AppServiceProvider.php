<?php

namespace App\Providers;
use App\Models\Comment;
use App\Models\Game;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\UserPolicy;
use App\Policies\GamePolicy;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        Game::class => GamePolicy::class,
        User::class => UserPolicy::class,
        Comment::class => CommentPolicy::class,
    ];
    public function boot(): void
    {
        // Disable foreign key checks for MySQL
        if (DB::getDriverName() === 'mysql') {
            Schema::disableForeignKeyConstraints();
        }
    }
}
