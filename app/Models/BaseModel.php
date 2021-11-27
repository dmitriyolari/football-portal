<?php


namespace App\Models;


use App\Contracts\Models\ModelContract;
use App\Models\Traits\Id;
use App\Models\Traits\Locking;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model implements ModelContract
{
    use Id, Locking;

}
