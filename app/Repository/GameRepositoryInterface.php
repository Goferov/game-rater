<?php

namespace App\Repository;

interface GameRepositoryInterface
{
    public function all();
    public function get(int $gameId);
    public function allPaginated(int $limit = 10);
    public function best();
    public function stats();
    public function scoreStats();
}
