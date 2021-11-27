<?php


namespace App\Repositories\Eloquent\Domain;


use App\Contracts\DTO\DTOContract;
use App\Contracts\Repositories\RepositoryContract;
use App\DTO\Domain\CategoryDTO;
use App\Models\Category;
use App\Repositories\Eloquent\Repository;

class CategoryRepository extends Repository implements RepositoryContract
{
    function modelClass(): string
    {
        return Category::class;
    }

    /**
     * @param CategoryDTO $data
     *
     * @return Category
     */
    public function create(DTOContract $data): Category
    {
        /** @var Category $model */
        $model = $this->builder->create($data->all());
        return $model;
    }
}
