<?php

namespace App\Repository;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GameRepository implements GameRepositoryInterface
{

    private Game $gameModel;

    public function __construct(Game $gameModel)
    {
        $this->gameModel= $gameModel;
    }

    public function all(): array|Collection
    {
        return $this->gameModel
            ->with('genres')
            ->orderBy('created_at')
            ->get();
    }

    public function get(int $gameId)
    {
        return $this->gameModel->find($gameId);
    }

    public function allPaginated(int $limit = 10)
    {
        return $this->gameModel->with('genres')
            ->orderBy('created_at')
            ->with('genres')
            ->paginate($limit);
    }

    public function best()
    {
        return $this->gameModel
            ->best()
            ->with('genres')
            ->get();
    }

    public function stats()
    {
        return [
            'count' => $this->gameModel->count(),
            'countScoreGtSeventy' => $this->gameModel->where('metacritic_score', '>=', 70)->count(),
            'max' => $this->gameModel->max('metacritic_score'),
            'min' => $this->gameModel->min('metacritic_score'),
            'avg' => round($this->gameModel->avg('metacritic_score'), 2),
        ];
    }

    public function scoreStats()
    {
        return $this->gameModel->select(
            $this->gameModel->raw('count(*) as count'), 'metacritic_score'
        )
            ->having('metacritic_score', '>=', 70)
            ->groupBy('metacritic_score')
            ->orderBy('metacritic_score', 'desc')
            ->get();
    }

    public function filterBy(?string $phrase, string $type = self::TYPE_DEFAULT, int $limit = 15)
    {
        $query =  $this->gameModel
                    ->with('genres')
                    ->orderBy('created_at');


        if(!isset(self::ALL_TYPES[$type])) {
            $type = self::TYPE_DEFAULT;
        }

        if($type !== self::TYPE_ALL) {
            $query->where('type', $type);
        }

        if($phrase) {
            $query->whereRaw('name LIKE ?', ["$phrase%"]);
        }

        return $query->paginate($limit);
    }
}
