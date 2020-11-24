<?php

namespace App\Models;

use App\Models\Traits\SafeDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Customer model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @method static Customer findOrFail(int $id)
 *
 * @property int $id
 * @property string $name
 */
class Customer extends Model
{
    use HasFactory;
    use SafeDelete;

    const ATTR_ID = 'id';
    const ATTR_NAME = 'name';

    public $fillable = [
        self::ATTR_NAME,
    ];

    /**
     * Get related teams.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Get related projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get related entries.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany(Entry::class, Entry::ATTR_CUSTOMER_ID);
    }

    /**
     * Is customer deletable?
     *
     * @return bool
     */
    public function isDeletable(): bool
    {
        return $this->entries->count() === 0;
    }
}
