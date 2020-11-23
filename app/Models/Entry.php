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
 */
class Entry extends Model
{
    use HasFactory;
    use SoftDeletes;

    const ATTR_ID = 'id';
    const ATTR_START = 'start';
    const ATTR_END = 'end';
    const ATTR_DESCRIPTION = 'description';
}
