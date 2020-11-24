<?php

namespace App\Models\Traits;

use App\Exceptions\NotDeletableException;

/**
 * Checks whether model is deletable before deleting.
 *
 * @package App\Models\Traits
 */
trait SafeDelete
{
    /**
     * Is model deletable?
     *
     * @return bool
     */
    abstract public function isDeletable(): bool;

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        if (!$this->isDeletable()) {
            $shortName = collect(explode('\\', get_class($this)))
                ->last();

            throw new NotDeletableException($shortName . ' is not deletable.');
        }

        parent::delete();
    }
}
