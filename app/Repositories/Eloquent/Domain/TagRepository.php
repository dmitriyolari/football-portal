<?php


namespace App\Repositories\Eloquent\Domain;


use App\Contracts\DTO\DTOContract;
use App\Contracts\Repositories\RepositoryContract;
use App\DTO\Domain\TagDTO;
use App\Models\Tag;
use App\Repositories\Eloquent\Repository;

class TagRepository extends Repository implements RepositoryContract
{
    function modelClass(): string
    {
        return Tag::class;
    }

    /**
     * @param TagDTO $data
     *
     * @return Tag
     */
    public function create(DTOContract $data): Tag
    {
        /** @var Tag $model */
        $model = $this->builder->create($data->all());
        return $model;
    }
}
