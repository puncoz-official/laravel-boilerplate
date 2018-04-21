<?php

namespace App\Data\Entities\Models\ActivityLog;

use App\Constants\DBTable;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityLog
 * @package App\Data\Entities\Models\ActivityLog
 */
class ActivityLog extends Activity
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $table = DBTable::LOGS_ACTIVITIES;
}
