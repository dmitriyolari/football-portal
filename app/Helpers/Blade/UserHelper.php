<?php


namespace App\Helpers\Blade;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserHelper
 *
 * @package App\Helpers\Blade
 */
class UserHelper
{
    /**
     * @var User
     */
    private $user;

    /**
     * Get current user in constructor
     *
     * UserHelper constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->user->isAdmin();
    }

    /**
     * @return string
     */
    public function userName(): string
    {
        return $this->user->name;
    }

    /**
     * @return string
     */
    public function userEmail(): string
    {
        return $this->user->email;
    }

    /**
     * @return bool
     */
    public function isSubscribed(): bool
    {
        return $this->user->is_subscribed;
    }
}
