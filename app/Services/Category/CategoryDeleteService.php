<?php


namespace App\Services\Category;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\Eloquent\Domain\CategoryRepository;
use App\Repositories\Eloquent\Domain\PostRepository;
use Exception;

class CategoryDeleteService
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * CategoryDeleteService constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Category $category
     * @return bool
     * @throws Exception
     */
    public function delete(Category $category): bool
    {
        return $this->categoryRepository->delete($category->id());
    }
}
