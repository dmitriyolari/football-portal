<?php

namespace App\Http\Controllers\Admins;

use App\DTO\Domain\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\Category\CategoryCreateService;
use App\Services\Category\CategoryUpdateService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Admins
 */
class CategoryController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $categories = Category::all();
        return view("admin.categories.index")->with(['categories' => $categories]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view("admin.categories.create");
    }

    /**
     * @param StoreCategoryRequest $request
     * @param CategoryCreateService $service
     *
     * @return RedirectResponse
     * @throws UnknownProperties
     */
    public function store(StoreCategoryRequest $request, CategoryCreateService $service): RedirectResponse
    {
        $service->create(new CategoryDTO($request->validated()));
        session()->flash('success', 'Категория создана');

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param Category $category
     *
     * @return View
     */
    public function edit(Category $category): View
    {
        return view("admin.categories.edit")->with(['category' => $category]);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @param CategoryUpdateService $service
     *
     * @return RedirectResponse
     * @throws UnknownProperties
     */
    public function update(UpdateCategoryRequest $request, Category $category, CategoryUpdateService $service): RedirectResponse
    {
        $ok = $service->update($category, new CategoryDTO($request->validated()));
        if ($ok) {
            session()->flash('success', 'Категория обновлена');
        } else {
            session()->flash('success', 'Ошибка обновления категории');
        }


        return redirect()->route('admin.categories.index');
    }

    /**
     * @param Category $category
     * @param Post $post
     * @return RedirectResponse
     */
    public function delete(Category $category, Post $post): RedirectResponse
    {
        if (count($category->posts)) {
            session()->flash('error', 'Категория не удалена: у нее есть посты');
        } else {
            $category->delete();
            session()->flash('success', 'Категория Удалена');
        }

        return redirect()->route('admin.categories.index');
    }
}
