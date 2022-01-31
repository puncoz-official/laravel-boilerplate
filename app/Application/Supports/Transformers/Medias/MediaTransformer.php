<?php

namespace App\Application\Supports\Transformers\Medias;

use App\Domain\Medias\Models\Media;
use League\Fractal\TransformerAbstract;

/**
 * Class MediaTransformer
 *
 * @package App\Application\Supports\Transformers\Medias
 */
class MediaTransformer extends TransformerAbstract
{
    public function transform(Media $media): array
    {
        return [
            'id'         => $media->id,
            'file_name'  => $media->file_name,
            'url'        => $media->getFullUrl(),
            'size'       => [
                'byte'      => $media->size,
                'formatted' => $media->human_readable_size,
            ],
            'mime_type'  => $media->mime_type,
            'responsive' => [
                'thumb'  => $media->getUrl('thumb'),
                'small'  => $media->getUrl('small'),
                'medium' => $media->getUrl('medium'),
                'large'  => $media->getUrl('large'),
            ],
            'properties' => [],
        ];
    }
}
