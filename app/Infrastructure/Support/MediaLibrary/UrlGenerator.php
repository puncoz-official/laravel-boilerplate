<?php

namespace App\Infrastructure\Support\MediaLibrary;

use DateTimeInterface;
use Illuminate\Support\Facades\URL;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

/**
 * Class UrlGenerator
 *
 * @package App\Infrastructure\Support\MediaLibrary
 */
class UrlGenerator extends DefaultUrlGenerator
{
    public function getTemporaryUrl(DateTimeInterface $expiration, array $options = []): string
    {
        $path = $this->getPathRelativeToRoot();

        if ( config('media-library.disk_name') === 's3' ) {
            return $this->getDisk()->temporaryUrl($path, $expiration, $options);
        }

        return URL::temporarySignedRoute('media.image.url', $expiration, [
            'disk' => config('media-library.disk_name'),
            'path' => $path,
        ]);
    }

    public function getUrl(): string
    {
        return $this->getTemporaryUrl(now()->addSeconds(config('config.file_expiration')));
    }
}
