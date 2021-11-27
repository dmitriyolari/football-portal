<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Eloquent\Domain\UserRepository;

class UserDeleteService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserDeleteService constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function delete(User $user)
    {
        return $this->userRepository->delete($user->id());
    }
}
