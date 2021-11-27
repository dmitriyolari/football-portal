<?php

namespace App\Services\Comment;

use App\Models\Comment;
use App\Repositories\Eloquent\Domain\CommentRepository;

class CommentRestoreService
{
    /**
     * @var CommentRepository
     */
    private CommentRepository $commentRepository;

    /**
     * PostRestoreService constructor
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
     */
    public function restore(Comment $comment): bool
    {
        return (bool)$this->commentRepository->restore($comment->id);
    }

}
