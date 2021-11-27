<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateNewPostNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Post $post;


    /**
     * Create a new notification instance.
     *
     * @param $post
     */
    public function __construct($post)
    {
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
        $post_id = $this->post->id;
        return (new MailMessage)
            ->line("$user_name, сообщаем Вам о появлении новой статьи. Чтобы открыть ее, нажмите кнопку ниже")
            ->action('Открыть статью', url(config("app.url")."/posts/$post_id"))
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
