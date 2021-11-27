<?php


namespace App\Services\Post;

use App\DTO\Domain\PostDTO;
use App\Models\Post;
use App\Repositories\Eloquent\Domain\PostRepository;

class PostUpdateService
{
    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    /**
     * PostUpdateService constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param Post $post
     * @param PostDTO $data
     *
     * @return bool
     */
    public function update(Post $post, PostDTO $data): bool
    {
        return (bool)$this->postRepository->update($data, $post->id());
    }
}
