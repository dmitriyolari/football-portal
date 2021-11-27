<?php

namespace App\DTO\Domain;

use App\Contracts\DTO\DTOContract;
use App\DTO\BaseDataTransferObject;

class CategoryDTO extends BaseDataTransferObject implements DTOContract
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
}
