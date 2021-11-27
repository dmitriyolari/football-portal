<?php

namespace App\Http\Controllers\Admins;

use App\DTO\Domain\TagDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreTagRequest;
use App\Http\Requests\Admin\Tag\UpdateTagRequest;
use App\Models\Tag;
use App\Services\Tag\TagCreateService;
use App\Services\Tag\TagUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TagController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $tags = Tag::all();
        return view("admin.tags.index")->with(['tags' => $tags]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view("admin.tags.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest  $request
     * @param TagCreateService $service
     *
     * @return RedirectResponse
     * @throws UnknownProperties
     */
    public function store(StoreTagRequest $request, TagCreateService $service): RedirectResponse
    {
        $service->create(new TagDTO($request->validated()));
        session()->flash('success', 'Тег создан');

        return redirect()->route('admin.tags.index');
    }

    /**
     * @param Tag $tag
     *
     * @return View
     */
    public function edit(Tag $tag): View
    {
        return view("admin.tags.edit")->with(['tag' => $tag]);
    }

    /**
     * @param UpdateTagRequest $request
     * @param Tag              $tag
     * @param TagUpdateService $service
     *
     * @return RedirectResponse
     * @throws UnknownProperties
     */
    public function update(UpdateTagRequest $request, Tag $tag, TagUpdateService $service): RedirectResponse
    {
        $ok = $service->update($tag, new TagDTO($request->validated()));
        if ($ok) {
            session()->flash('success', 'Тег обновлен');
        } else {
            session()->flash('success', 'Ошибка обновления тега');
        }

        return redirect()->route('admin.tags.index');
    }

    /**
     * @param Tag $tag
     *
     * @return RedirectResponse
     */
    public function delete(Tag $tag): RedirectResponse
    {
        $tag->delete();
        session()->flash('success', 'Тег удален');

        return redirect()->back();
    }
}
