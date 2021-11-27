<?php

namespace App\Contracts\Models;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Contract must be implemented for all models
 *
 * @package App\Contracts\Models
 */
interface ModelContract extends Arrayable
{
    /**
     * Entity ID
     *
     * @return int
     */
    public function id(): int;

    /**
     * Lock DB row for update
     *
     * @return $this
     */
    public function lockForUpdate(): ModelContract;

    /**
     * Lock DB row in share mode
     *
     * @return $this
     */
    public function shareLock(): ModelContract;

    /**
     * Lock DB row
     *
     * @param string|bool $type True -> lockForUpdate, False -> shareLock
     *
     * @return $this
     */
    public function lock($type): ModelContract;
}
