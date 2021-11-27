<?php


namespace App\DTO\Domain;


use App\Contracts\DTO\DTOContract;
use App\DTO\BaseDataTransferObject;

/**
 * Class TagDTO
 *
 * @package App\DTO\Domain
 */
class TagDTO extends BaseDataTransferObject implements DTOContract
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $slug;
}
