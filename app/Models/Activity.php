<?php

namespace App\Models;

use App\Models\Traits\SafeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Activity model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @method static Activity findOrFail(int $id)
 *
 * @property int $id
 * @property string $name
 */
class Activity extends Model
{
    use SafeDelete;
    use HasFactory;

    const ATTR_ID = 'id';
    const ATTR_NAME = 'name';

    public $fillable = [
        self::ATTR_NAME,
    ];

    /**
     * Get related entries.
     *
     * @return HasMany
     */
    public function entries()
    {
        return $this->hasMany(Entry::class, Entry::ATTR_ACTIVITY_ID);
    }

    /**
     * Is activity deletable?
     *
     * @return bool
     */
    public function isDeletable(): bool
    {
        return $this->entries->count() === 0;
    }
}
