<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'userGames')
            ->withPivot('rate')
            ->with('genres');
    }

    public function addGame(Game $game): void
    {
        $this->games()->save($game);
    }

    public function hasGame(int $gameId): bool
    {
        $game = $this->games()->where('userGames.game_id', $gameId)->first();
        return (bool)$game;
    }

    public function removeGame(Game $game): void
    {
        $this->games()->detach($game->id);
    }

    public function rateGame(Game $game, ?int $rate): void
    {
        $this->games()->updateExistingPivot($game, ['rate' => $rate]);
    }

    public function isAdmin(): bool
    {
        return (bool) $this->admin;
    }
}
