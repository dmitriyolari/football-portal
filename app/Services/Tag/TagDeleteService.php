<?php

namespace App\Services\Tag;

use App\Models\Tag;
use App\Repositories\Eloquent\Domain\TagRepository;
use Exception;

class TagDeleteService
{
    /**
     * @var TagRepository
     */
    private TagRepository $tagRepository;

    /**
     * TagDeleteService constructor
     *
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Tag $tag
     * @return bool
     * @throws Exception
     */
    public function delete(Tag $tag): bool
    {
        return $this->tagRepository->delete($tag->id());
    }

}
