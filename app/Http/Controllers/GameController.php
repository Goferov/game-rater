<?php

namespace App\Http\Controllers;

use App\Repository\GameRepository;
use App\Repository\GameRepositoryInterface;
use Illuminate\View\View;

class GameController extends Controller
{
    private GameRepositoryInterface $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function index(): View
    {
        return view('game.list', [
            'games' => $this->gameRepository->allPaginated()
        ]);
    }

    public function dashboard(): View
    {
        return view('game.dashboard', [
            'bestGames' => $this->gameRepository->best(),
            'stats' => $this->gameRepository->stats(),
            'scoreStats' => $this->gameRepository->scoreStats()
        ]);
    }

    public function show(int $gameId): View
    {
        return view('game.show', [
            'game' => $this->gameRepository->get($gameId)
        ]);
    }
}
