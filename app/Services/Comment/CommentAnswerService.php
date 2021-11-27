<?php


namespace App\Services\Comment;


use App\DTO\Domain\CommentDTO;
use App\Models\Comment;
use App\Repositories\Eloquent\Domain\CommentRepository;

/**
 * Class CommentCreateService
 *
 * @package App\Services\Category
 */
class CommentAnswerService
{
    /**
     * @var CommentRepository
     */
    private CommentRepository $commentRepository;

    /**
     * PostCreateService constructor.
     *
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param CommentDTO $data
     *
     * @return Comment
     */
    public function create(CommentDTO $data): Comment
    {
        $comment = $this->commentRepository->answer($data);

        return $comment;
    }

}
