<?php

namespace App\Models;

use Carbon\Carbon;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

/**
 * Team model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property boolean $personal_team
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Team extends JetstreamTeam
{
    const ATTR_ID = 'id';
    const ATTR_USER_ID = 'user_id';
    const ATTR_NAME = 'name';
    const ATTR_PERSONAL_TEAM = 'personal_team';
    const ATTR_CREATED_AT = 'created_at';
    const ATTR_UPDATED_AT = 'updated_at';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::ATTR_PERSONAL_TEAM => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_PERSONAL_TEAM,
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Get related teams.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
