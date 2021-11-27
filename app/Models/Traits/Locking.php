<?php

namespace App\Models\Traits;

use App\Contracts\Models\ModelContract;

/**
 * Trait could be used for implement locking-methods for Eloquent models
 *
 * Warning!!!
 * 1) Trait intended for Eloquent Models ONLY implemented ModelContract
 * 2) Functions will work correct inside DB Transaction only
 * 3) Object must implements ModelContract
 *
 * @package App\Models\Traits
 */
trait Locking
{
    /**
     * {@inheritDoc}
     *
     * @return ModelContract
     */
    public function lockForUpdate(): ModelContract
    {
        return $this->lock(true);
    }

    /**
     * {@inheritDoc}
     *
     * @return ModelContract
     */
    public function shareLock(): ModelContract
    {
        return $this->lock(false);
    }

    /**
     * {@inheritDoc}
     *
     * @param string|bool $type True -> lockForUpdate, False -> shareLock
     *
     * @return ModelContract
     */
    public function lock($type): ModelContract
    {
        return $this->query()->lock($type)->find($this->id());
    }
}
