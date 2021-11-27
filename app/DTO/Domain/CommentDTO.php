<?php

namespace App\DTO\Domain;

use App\Contracts\DTO\DTOContract;
use App\DTO\BaseDataTransferObject;

class CommentDTO extends BaseDataTransferObject implements DTOContract
{
    /**
     * @var int|null
     */
    public null|int $parent_id;

    /**
     * @var int|null
     */
    public null|int $user_id;

    /**
     * @var int|null
     */
    public null|int $post_id;

    /**
     * @var string
     */
    public string $text;

}
