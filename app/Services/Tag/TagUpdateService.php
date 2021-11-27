<?php


namespace App\Services\Tag;


use App\DTO\Domain\TagDTO;
use App\Models\Tag;
use App\Repositories\Eloquent\Domain\TagRepository;

class TagUpdateService
{
    /**
     * @var TagRepository
     */
    private TagRepository $tagRepository;

    /**
     * TagUpdateService constructor.
     *
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param Tag $tag
     * @param TagDTO $data
     *
     * @return bool
     */
    public function update(Tag $tag, TagDTO $data): bool
    {
        return (bool)$this->tagRepository->update($data, $tag->id());
    }
}
