<?php

namespace App\Http\Controllers\Admins;

use App\DTO\Domain\PostDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\CreateNewPostNotification;
use App\Services\Post\PostDeleteService;
use App\Services\Post\PostCreateService;
use App\Services\Post\PostRestoreService;
use App\Services\Post\PostUpdateService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

/**
 * Class PostAdminController
 *
 * @package App\Http\Controllers\Admins
 */
class PostAdminController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $posts = Post::withTrashed()->with('categories')->get();
        return view("admin.posts.index")->with(['posts' => $posts]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::pluck('title', 'id')->all();

        return view("admin.posts.create")->with(['categories' => $categories, 'tags' => $tags]);
    }

    /**
     *
     * @param StorePostRequest $request
     * @param PostCreateService $service
     *
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws UnknownProperties
     */
    public function store(StorePostRequest $request, PostCreateService $service): RedirectResponse
    {
        $post = $service->create(new PostDTO($request->validated()));

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $post->addMediaFromRequest('image')->toMediaCollection('post_images');
        }
        $users = User::where('is_admin', false)->get();
        Notification::send($users, new CreateNewPostNotification($post));

        session()->flash('success', 'Пост создан');

        return redirect()->route('admin.posts.index');
    }

    /**
     * @param Post $post
     * @param Category $category
     * @return View
     */
    public function edit(Post $post, Category $category): View
    {
        $categories = Category::pluck('title', 'id')->all();
        $tags = Tag::all()->pluck('title', 'id');
        $post->loadMissing(['tags', 'categories']);

        return view("admin.posts.edit")->with(['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @param PostUpdateService $service
     *
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws UnknownProperties
     */
    public function update(UpdatePostRequest $request, Post $post, PostUpdateService $service): RedirectResponse
    {
        $service->update($post, new PostDTO($request->validated()));

        if ($request->image_delete) {
            $post->clearMediaCollection('post_images');
        }

        if($request->hasFile('image') && $request->file('image')->isValid()){
            if ($post->getMedia('post_images')->isNotEmpty()) {
                $post->clearMediaCollection('post_images');
                $post->addMediaFromRequest('image')->toMediaCollection('post_images');
            } else {
                $post->addMediaFromRequest('image')->toMediaCollection('post_images');
            }
        }

        session()->flash('success', 'Пост обновлен');

        return redirect()->route('admin.posts.index');
    }

    /**
     * @param Post $post
     * @param PostDeleteService $service
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Post $post, PostDeleteService $service): RedirectResponse
    {
        $service->delete($post);
        session()->flash('success', 'Пост удален');

        return redirect()->back();
    }

    /**
     * @param Post $post
     * @param PostRestoreService $service
     * @return RedirectResponse
     */
    public function restore(Post $post, PostRestoreService $service): RedirectResponse
    {
        $service->restore($post);
        session()->flash('success', 'Пост восстановлен');

        return redirect()->back();
    }
}
