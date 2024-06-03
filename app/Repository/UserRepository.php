<?php


namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function updateModel(User $user, array $data): void
    {
        $user->email = $data['email'] ?? $user->email;
        $user->name = $data['name'] ?? $user->name;
        $user->phone = $data['phone'] ?? $user->phone;
        $user->avatar = $data['avatar'] ?? $user->avatar;

        $user->save();
    }

    public function all(): Collection
    {
        return $this->userModel->get();
    }
    public function get(int $id): User
    {
        return $this->userModel->find($id);
    }
}
