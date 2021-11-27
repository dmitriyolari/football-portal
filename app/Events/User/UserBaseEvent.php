<?php

namespace App\Events\User;

use App\Models\User;

/**
 * Class UserBaseEvent
 *
 * @package App\Events\User
 */
abstract class UserBaseEvent
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
    }
}
