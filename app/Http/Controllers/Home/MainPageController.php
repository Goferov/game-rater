<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repository\GameRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    private GameRepositoryInterface $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function index()
    {
        return view('home.main', [
            'user' => Auth::user(),
            'bestGames' => $this->gameRepository->best(),
            'stats' => $this->gameRepository->stats(),
            'scoreStats' => $this->gameRepository->scoreStats()
        ]);
    }
}
