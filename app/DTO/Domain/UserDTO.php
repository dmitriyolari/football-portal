<?php

namespace App\DTO\Domain;

use App\Contracts\DTO\DTOContract;
use App\DTO\BaseDataTransferObject;

class UserDTO extends BaseDataTransferObject implements DTOContract
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;

}
