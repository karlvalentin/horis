<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Customer model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @property int $id
 * @property string $name
 */
class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    const ATTR_ID = 'id';
    const ATTR_NAME = 'name';

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
}
