<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        $games = Game::with('genre')
            ->paginate(10);

        return view('game.list', [
            'games' => $games
        ]);
    }

    public function dashboard(): View
    {
        $bestGames = Game::best()->get();

        $stats = [
            'count' => Game::count(),
            'countScoreGtSeven' => Game::where('score', '>', 7)->count(),
            'max' => Game::max('score'),
            'min'=> Game::min('score'),
            'avg'=> Game::avg('score'),
        ];

        $scoreStats = Game::select(
            Game::raw('count(*) as count'), 'score'
        )
            ->having('count', '>', 10)
            ->groupBy('score')
            ->orderBy('count', 'desc')
            ->get();

        return view('game.dashboard', [
            'bestGames' => $bestGames,
            'stats' => $stats,
            'scoreStats' => $scoreStats
        ]);
    }

    public function show(int $gameId): View
    {
        $game = Game::find($gameId);

        return view('game.show', [
            'game' => $game
        ]);
    }
}
