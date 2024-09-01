<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddGameToUserList;
use App\Http\Requests\RateGame;
use App\Http\Requests\RemoveGameFromUserList;
use App\Repository\GameRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GameController extends Controller
{

    private GameRepositoryInterface $gameRepository;

    public function __construct(GameRepositoryInterface $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function list(): View
    {
        $user = Auth::user();

        return view('me.game.list', [
            'games' => $user->games()->paginate()
        ]);
    }

    public function add(AddGameToUserList $request)
    {
        $data = $request->validated();
        $gameId = (int) $data['gameId'];

        $game = $this->gameRepository->get($gameId);
        $user = Auth::user();
        $user->addGame($game);

        return redirect()
            ->route('games.show', ['game' => $gameId])
            ->with('success', 'Gra została dodana');

    }

    public function remove(RemoveGameFromUserList $request)
    {
        $data = $request->validated();
        $gameId = (int) $data['gameId'];

        $game = $this->gameRepository->get($gameId);

        $user = Auth::user();
        $user->removeGame($game);

        return redirect()
            ->route('games.show', ['game' => $gameId])
            ->with('success', 'Gra została usunięta');
    }

    public function rate(RateGame $request)
    {
        $data = $request->validated();
        $gameId = (int) $data['gameId'];
        $rate = $data['rate'] ? (int) $data['rate'] : null;

        $game = $this->gameRepository->get($gameId);

        $user = Auth::user();
        $user->rateGame($game, $rate);

        return redirect()
            ->route('me.games.list')
            ->with('success', 'Ocena została zapisana');
    }
}
