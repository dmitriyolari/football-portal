<?php

namespace App\Events\Post;

use App\Models\Post;

/**
 * Class UserBaseEvent
 *
 * @package App\Events\User
 */
abstract class PostBaseEvent
{
    public Post $post;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
