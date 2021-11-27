<?php


namespace App\Services\Category;


use App\DTO\Domain\CategoryDTO;
use App\Models\Category;
use App\Repositories\Eloquent\Domain\CategoryRepository;

class CategoryUpdateService
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * CategoryUpdateService constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Category $category
     * @param CategoryDTO $data
     *
     * @return bool
     */
    public function update(Category $category, CategoryDTO $data): bool
    {
        return (bool)$this->categoryRepository->update($data, $category->id());
    }
}
