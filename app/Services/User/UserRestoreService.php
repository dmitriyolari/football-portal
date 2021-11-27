<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Eloquent\Domain\UserRepository;

class UserRestoreService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserRestoreService constructor
     *
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
    public function restore(User $user): bool
    {
        return (bool)$this->userRepository->restore($user->id);
    }
}
