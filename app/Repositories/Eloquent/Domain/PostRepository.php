<?php


namespace App\Repositories\Eloquent\Domain;


use App\Contracts\DTO\DTOContract;
use App\Contracts\Repositories\RepositoryContract;
use App\DTO\Domain\PostDTO;
use App\Models\Post;
use App\Repositories\Eloquent\Repository;

class PostRepository extends Repository implements RepositoryContract
{
    function modelClass(): string
    {
        return Post::class;
    }

    /**
     * @param   PostDTO $data
     * @return  Post
     */
    public function create(DTOContract $data): Post
    {
        $post = new Post();
        $post->fill($data->all());
        $post->categories()->associate($data->category_id);
        $post->save();

        if (!empty($data->tags)) {
            $post->tags()->attach($data->tags);
        }

        return $post;
    }

    /**
     * @param PostDTO   $data
     * @param int       $id
     * @param string    $attribute
     *
     * @return int
     */
    public function update(DTOContract $data, int $id, $attribute = "id"): int
    {
        /** @var Post $post */
        $post = $this->builder->where($attribute, '=', $id)->first();
        if (!$post->update($data->all())) {
            return false;
        }
        if (!empty($data->tags)) {
            $post->tags()->sync($data->tags);
        } else {
            $post->tags()->detach();
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
        Post::withTrashed()->find($id)->restore();

        return true;
    }
}
