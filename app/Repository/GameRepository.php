<?php

namespace App\Repository;

use App\Models\Game;

class GameRepository implements GameRepositoryInterface
{

    private Game $gameModel;

    public function __construct(Game $gameModel)
    {
        $this->gameModel= $gameModel;
    }

    public function all()
    {
        return $this->gameModel
            ->with('genre')
            ->orderBy('created_at')
            ->get();
    }

    public function get(int $gameId)
    {
        return $this->gameModel->find($gameId);
    }

    public function allPaginated(int $limit = 10)
    {
        return $this->gameModel->with('genre')
            ->orderBy('created_at')
            ->paginate($limit);
    }

    public function best()
    {
        return $this->gameModel
            ->best()
            ->get();
    }

    public function stats()
    {
        return [
            'count' => $this->gameModel->count(),
            'countScoreGtSeven' => $this->gameModel->where('score', '>', 7)->count(),
            'max' => $this->gameModel->max('score'),
            'min'=> $this->gameModel->min('score'),
            'avg'=> $this->gameModel->avg('score'),
        ];
    }

    public function scoreStats()
    {
        return $this->gameModel->select(
            $this->gameModel->raw('count(*) as count'), 'score'
        )
            ->having('count', '>', 10)
            ->groupBy('score')
            ->orderBy('count', 'desc')
            ->get();
    }
}
