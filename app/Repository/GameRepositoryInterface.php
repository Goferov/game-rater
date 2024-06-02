<?php

namespace App\Repository;

interface GameRepositoryInterface
{
    public const TYPE_DEFAULT = 'game';
    public const TYPE_ALL = 'all';
    public const ALL_TYPES = [
        'all' => 'Wszystkie rodzaje',
        'game' => 'Gry',
        'dlc' => 'DLC',
        'demo' => 'Demo',
        'episode' => 'Epizody',
        'mod' => 'Mody',
        'movie' => 'Filmy',
        'music' => 'Muzyka',
        'series' => 'Serie',
        'video' => 'Video',
    ];

    public function all();
    public function get(int $gameId);
    public function allPaginated(int $limit = 10);
    public function best();
    public function stats();
    public function scoreStats();
    public function filterBy(?string $phrase, string $type = self::TYPE_DEFAULT, int $limit = 15);
}
