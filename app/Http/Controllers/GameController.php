<?php

namespace App\Http\Controllers;

use App\Repository\GameRepository;
use App\Repository\GameRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GameController extends Controller
{
    private GameRepositoryInterface $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function index(Request $request): View
    {

        $phrase = $request->get('phrase');
        $selectedType = $request->get('selectedType', GameRepositoryInterface::TYPE_DEFAULT);
        $limit = $request->get('limit', 15);

        $resultPaginator = $this->gameRepository->filterBy($phrase, $selectedType, $limit);
        $resultPaginator->appends([
            'phrase' => $phrase,
            'selectedType' => $selectedType
        ]);

        return view('game.list', [
            'games' => $resultPaginator,
            'phrase' => $phrase,
            'selectedType' => $selectedType,
            'allTypes' => GameRepositoryInterface::ALL_TYPES
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
        $user = Auth::user();
        $userHasGame = $user->hasGame($gameId);

        return view('game.show', [
            'game' => $this->gameRepository->get($gameId),
            'userHasGame' => $userHasGame
        ]);
    }
}
