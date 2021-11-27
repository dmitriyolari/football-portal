<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCommentAnswerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $user_answered_name;
    private Post $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_answered_name, $post)
    {
        $this->user_answered_name = $user_answered_name;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param User $user
     * @return MailMessage
     */
    public function toMail(User $user): MailMessage
    {
        $user_name = $user->name;
        $post_id = $this->post->id();
        return (new MailMessage)
                    ->line("Здравствуйте, $user_name. Пользователь $this->user_answered_name ответил на Ваш комментарий")
                    ->action('Посмотреть', url(config("app.url")."/posts/$post_id"))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
