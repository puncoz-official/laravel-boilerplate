<?php

namespace App\Domain\Users\Models;

use Carbon\Carbon;
use Spatie\Permission\Models\Role as BaseRole;

/**
 * Class Role
 *
 * @package App\Domain\Users\Models
 *
 * @property int    $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Role extends BaseRole
{

}
