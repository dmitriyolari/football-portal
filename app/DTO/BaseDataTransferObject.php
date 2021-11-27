<?php


namespace App\DTO;


use App\Contracts\DTO\DTOContract;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseDataTransferObject extends DataTransferObject implements DTOContract
{

}
