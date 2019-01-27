<?php

namespace App\Data\Entities\Models\Log;

use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityLog
 * @package App\Data\Entities\Models\Log
 */
class ActivityLog extends Activity
{
    /**
     * @var bool
     */
    public $incrementing = false;
}
