<?php


namespace App\Services\Post;

use App\Models\Post;
use App\Repositories\Eloquent\Domain\PostRepository;
use Exception;

class PostDeleteService
{
    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    /**
     * PostDeleteService constructor.
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
     * @throws Exception
     */
    public function delete(Post $post): bool
    {
        return $this->postRepository->delete($post->id());
    }
}
