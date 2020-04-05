<?php

namespace App\Data\Entities\User;

use Carbon\Carbon;
use Spatie\Permission\Models\Permission as BasePermission;

/**
 * Class Permission
 * @package App\Data\Entities\User
 *
 * @property int    $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Permission extends BasePermission
{

}
