<?php

namespace App\Models\Traits;

/**
 * Trait provide standard id() method based in id-field (for Eloquent models)
 *
 * @package App\Models\Traits
 * @property int $id
 */
trait Id
{
    /**
     * Retrieve entity ID
     *
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }
}
