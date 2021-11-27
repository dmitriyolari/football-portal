<?php


namespace App\Services\Tag;


use App\DTO\Domain\TagDTO;
use App\Models\Tag;
use App\Repositories\Eloquent\Domain\PostRepository;
use App\Repositories\Eloquent\Domain\TagRepository;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class PostCreateService
 *
 * @package App\Services\Category
 */
class TagCreateService
{
    /**
     * @var TagRepository
     */
    private TagRepository $tagRepository;

    /**
     * PostCreateService constructor.
     *
     * @param TagRepository $tagRepository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param TagDTO $data
     *
     * @return Tag
     */
    public function create(TagDTO $data): Tag
    {
        return $this->tagRepository->create($data);
    }
}
