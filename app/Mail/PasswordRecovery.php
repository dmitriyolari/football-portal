<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRecovery extends Mailable
{
    use Queueable, SerializesModels;

    private User $user;
    /**
     * Create a new message instance.
     *
     * @return User
     */
    public function __construct(User $user)
    {
        return $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_name = $this->user->name;
        return $this->view('user.password_recovery-email')->with(['user_name' => $user_name]);
    }
}
