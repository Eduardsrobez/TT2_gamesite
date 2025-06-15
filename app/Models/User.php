<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function testerReviews()
    {
        return $this->hasMany(TesterReview::class);
    }
    public function AuditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
    public function isDeveloper(): bool
    {
        return $this->role === 'Game-Developer';
    }
    public function isTester(): bool
    {
        return $this->role === 'tester';
    }
    public function isRoot(): bool
    {
        return $this->role === 'root';
    }
    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'root';
    }
}
