<?php


namespace App\Services\User;


use App\DTO\Domain\UserDTO;
use App\Events\User\UserRegisterEvent;
use App\Models\User;
use App\Repositories\Eloquent\Domain\UserRepository;

/**
 * Class UserRegisterService
 *
 * @package App\Services\User
 */
class UserRegisterService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserRegisterService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserDTO $data
     *
     * @return User
     */
    public function register(UserDTO $data): User
    {
        $user = $this->userRepository->create($data);
        $this->fireEvent($user);

        return $user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    protected function fireEvent(User $user): self
    {
        event(new UserRegisterEvent($user));
        return $this;
    }
}
