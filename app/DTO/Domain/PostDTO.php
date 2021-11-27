<?php

namespace App\DTO\Domain;

use App\Contracts\DTO\DTOContract;
use App\DTO\BaseDataTransferObject;

class PostDTO extends BaseDataTransferObject implements DTOContract
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $slug;

    /**
     * @var string
     */
    public string $preview_text;

    /**
     * @var string
     */
    public string $text;

    /**
     * @var int|null
     */
    public null|int $category_id;

    /**
     * @var array|null []int
     */
    public null|array $tags;

}
