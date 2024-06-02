<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile(): View
    {
        return view('me.profile', [
            'user' => Auth::user()
        ]);
    }

    public function edit(): View
    {
        return view('me.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(UpdateUserProfile $request)
    {
        $this->userRepository->updateModel(
            Auth::user(), $request->validated()
        );

        return redirect()
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }
}
