<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Entry model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @property int $id
 * @property Carbon $start
 * @property Carbon $end
 * @property string $description
 * @property int $project_id
 * @property int $customer_id
 * @property int $user_id
 * @property int $activity_id
 */
class Entry extends Model
{
    use HasFactory;
    use SoftDeletes;

    const ATTR_ID = 'id';
    const ATTR_START = 'start';
    const ATTR_END = 'end';
    const ATTR_DESCRIPTION = 'description';
    const ATTR_PROJECT_ID = 'project_id';
    const ATTR_CUSTOMER_ID = 'customer_id';
    const ATTR_USER_ID = 'user_id';
    const ATTR_ACTIVITY_ID = 'activity_id';

    public $fillable = [
        self::ATTR_START,
        self::ATTR_END,
        self::ATTR_DESCRIPTION,
        self::ATTR_PROJECT_ID,
        self::ATTR_CUSTOMER_ID,
        self::ATTR_USER_ID,
        self::ATTR_ACTIVITY_ID,
    ];
}
