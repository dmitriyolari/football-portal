<?php


namespace App\Services\Category;


use App\DTO\Domain\CategoryDTO;
use App\Models\Category;
use App\Repositories\Eloquent\Domain\CategoryRepository;

/**
 * Class PostCreateService
 *
 * @package App\Services\Category
 */
class CategoryCreateService
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * PostCreateService constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param CategoryDTO $data
     *
     * @return Category
     */
    public function create(CategoryDTO $data): Category
    {
        return $this->categoryRepository->create($data);
    }
}
