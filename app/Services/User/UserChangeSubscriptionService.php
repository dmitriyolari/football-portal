<?php

namespace App\Services\User;

use App\Repositories\Eloquent\Domain\UserRepository;

class UserChangeSubscriptionService
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
     * @return bool
     */
    public function returnSubscription(): bool
    {
        return $this->userRepository->returnSubscription();
    }

    /**
     * @return bool
     */
    public function cancelSubscription(): bool
    {
        return $this->userRepository->cancelSubscription();
    }
}
