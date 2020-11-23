<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Project model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @property int $id
 * @property string $name
 * @property boolean $active
 */
class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    const ATTR_ID = 'id';
    const ATTR_NAME = 'name';
    const ATTR_ACTIVE = 'active';

    /**
     * Get related customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
