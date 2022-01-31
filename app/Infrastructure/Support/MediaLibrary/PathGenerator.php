<?php

namespace App\Infrastructure\Support\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\DefaultPathGenerator;

/**
 * Class PathGenerator
 *
 * @package App\Infrastructure\Support\MediaLibrary
 */
class PathGenerator extends DefaultPathGenerator
{
    /*
        * Get a unique base path for the given media.
        */
    protected function getBasePath(Media $media): string
    {
        return sprintf("reaching/%s", md5($media->getKey()));
    }
}
