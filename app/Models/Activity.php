<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Activity model.
 *
 * @author Karl Valentin <karl.valentin@kvis.de>
 *
 * @property int $id
 * @property string $name
 */
class Activity extends Model
{
    const ATTR_ID = 'id';
    const ATTR_NAME = 'name';

    use HasFactory;
    use SoftDeletes;
}
