<?php


namespace App\Services\Post;


use App\DTO\Domain\PostDTO;
use App\Events\Post\PostStoreEvent;
use App\Models\Post;
use App\Repositories\Eloquent\Domain\PostRepository;

/**
 * Class PostCreateService
 *
 * @package App\Services\Category
 */
class PostCreateService
{
    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    /**
     * PostCreateService constructor.
     *
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param PostDTO $data
     *
     * @return Post
     */
    public function create(PostDTO $data): Post
    {
        $post = $this->postRepository->create($data);
        $this->fireEvent($post);

        return $post;
    }

    /**
     * @param Post $post
     *
     * @return $this
     */
    protected function fireEvent(Post $post): self
    {
        event(new PostStoreEvent($post));
        return $this;
    }
}
