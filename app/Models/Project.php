<?php

namespace App\Models;

use App\Models\Traits\SafeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Project model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @method static Project findOrFail(int $id)
 *
 * @property int $id
 * @property string $name
 * @property boolean $active
 */
class Project extends Model
{
    use HasFactory;
    use SafeDelete;

    const ATTR_ID = 'id';
    const ATTR_NAME = 'name';
    const ATTR_ACTIVE = 'active';

    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_ACTIVE,
    ];

    protected $casts = [
        self::ATTR_ACTIVE => 'boolean',
    ];

    /**
     * Get related customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get related entries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany(Entry::class, Entry::ATTR_PROJECT_ID);
    }

    /**
     * Is project deletable?
     *
     * @return bool
     */
    public function isDeletable(): bool
    {
        return $this->entries->count() === 0;
    }
}
