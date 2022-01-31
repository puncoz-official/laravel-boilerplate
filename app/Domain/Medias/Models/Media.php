<?php

namespace App\Domain\Medias\Models;

use App\Enums\DBTables;
use Carbon\Carbon;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

/**
 * Class Media
 *
 * @package App\Domain\Medias\Models
 *
 * @property int    $id
 * @property string $model_type
 * @property int    $model_id
 * @property string $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string $mime_type
 * @property string $disk
 * @property string $conversions_disk
 * @property int    $size
 * @property object $manipulations
 * @property object $custom_properties
 * @property object $generated_conversions
 * @property object $responsive_images
 * @property int    $order_column
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property string $human_readable_size
 */
class Media extends BaseMedia
{
    protected $table = DBTables::SYS_MEDIAS;
}
