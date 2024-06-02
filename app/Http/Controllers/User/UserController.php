<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $user = Auth::user();
        $data = $request->validated();

        if (!empty($data['avatar'])) {
            $path = $data['avatar']->store('avatars', 'public');

            if ($path) {
                $this->deleteAvatar($user);
                $data['avatar'] = $path;
            }
        }

        if(isset($data['delete-avatar'])) {
            $this->deleteAvatar($user);
            $data['avatar'] = '';
        }


        $this->userRepository->updateModel(
            $user, $data
        );

        return redirect()
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }

    private function deleteAvatar($user)
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }
    }
}
