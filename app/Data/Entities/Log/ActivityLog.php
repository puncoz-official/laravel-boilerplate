<?php

namespace App\Data\Entities\Log;

use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityLog
 * @package App\Data\Entities\Log
 *
 * @property int    $id
 * @property string $log_name
 * @property string $description
 * @property object $properties
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ActivityLog extends Activity
{
    /**
     * @var bool
     */
    public $incrementing = false;
}
