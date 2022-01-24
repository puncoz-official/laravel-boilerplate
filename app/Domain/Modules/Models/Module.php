<?php

namespace App\Domain\Modules\Models;

use App\Enums\DBTables;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 *
 * @package App\Domain\Modules\Models
 *
 * @property int    $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Module extends Model
{
    protected $table = DBTables::SYS_MODULES;

    protected $fillable = [
        'name',
    ];
}
