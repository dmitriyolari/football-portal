<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\Eloquent\Domain\PostRepository;

class PostRestoreService
{
    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    /**
     * PostRestoreService constructor
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function restore(Post $post): bool
    {
        return (bool)$this->postRepository->restore($post->id);
    }

}
