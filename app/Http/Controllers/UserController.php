<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\UserRepositoryInterface;
use Faker\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list(Request $request): View
    {
        Gate::authorize('admin-level');
        return view('user.list', ['users' => $this->userRepository->all()]);
    }

    public function show(int $userId): View
    {
        Gate::authorize('admin-level');
        return view('user.show', ['user' => $this->userRepository->get($userId)]);
    }
}
