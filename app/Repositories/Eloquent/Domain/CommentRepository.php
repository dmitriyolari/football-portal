<?php


namespace App\Repositories\Eloquent\Domain;


use App\Contracts\DTO\DTOContract;
use App\Contracts\Repositories\RepositoryContract;
use App\DTO\Domain\CommentDTO;
use App\Models\Comment;
use App\Repositories\Eloquent\Repository;

class CommentRepository extends Repository implements RepositoryContract
{
    function modelClass(): string
    {
        return Comment::class;
    }

    /**
     * @param CommentDTO $data
     * @return Comment
     */
    public function create(DTOContract $data): Comment
    {
        $comment = new Comment();
        $comment->fill($data->all());
        $comment->users()->associate($data->user_id);
        $comment->posts()->associate($data->post_id);
        $comment->save();

        return $comment;
    }

    /**
     * @param CommentDTO $data
     * @return Comment
     */
    public function answer(DTOContract $data): Comment
    {
        $comment = new Comment();
        $comment->fill($data->all());

        $comment->parent()->associate($data->parent_id);
        $comment->users()->associate($data->user_id);
        $comment->posts()->associate($data->post_id);

        $comment->save();

        return $comment;
    }

    /**
     * @param CommentDTO   $data
     * @param int       $id
     * @param string    $attribute
     *
     * @return int
     */
    public function update(DTOContract $data, int $id, $attribute = "id"): int
    {
        /** @var Comment $comment */
        $comment = $this->builder->where($attribute, '=', $id)->first();
        if (!$comment->update($data->all())) {
            return false;
        }
        return true;
    }

    /**
     * @param $id
     *
     * @return int
     */
    public function restore($id): int
    {
        Comment::withTrashed()->find($id)->restore();

        return true;
    }
}
