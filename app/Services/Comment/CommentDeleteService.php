<?php


namespace App\Services\Comment;

use App\Models\Comment;
use App\Repositories\Eloquent\Domain\CommentRepository;
use Exception;

class CommentDeleteService
{
    /**
     * @var CommentRepository
     */
    private CommentRepository $commentRepository;

    /**
     * PostDeleteService constructor.
     *
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param Comment $comment
     * @return bool
     * @throws Exception
     */
    public function delete(Comment $comment): bool
    {
        return $this->commentRepository->delete($comment->id());
    }
}
