<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Eloquent\Domain\UserRepository;

class UserMakeToAdminService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function makeAdmin(User $user): bool
    {
        return $this->userRepository->makeAdmin($user->id);
    }
}
