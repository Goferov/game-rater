<?php

namespace App\Repository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function updateModel(User $user, array $data): void;
}
