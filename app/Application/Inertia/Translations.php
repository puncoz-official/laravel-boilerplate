<?php

namespace App\Application\Inertia;

use App\Infrastructure\Support\Inertia\InertiaDataSharable;
use App\Libraries\Translations\TranslationCaching;
use Closure;

/**
 * Class TranslationsData
 *
 * @package App\Application\Inertia
 */
class Translations implements InertiaDataSharable
{

    public function key(): string
    {
        return 'translations';
    }

    public function data(): Closure|array
    {
        return function () {
            $translations = new TranslationCaching();
            $locale       = app()->getLocale();

            if ( app()->environment('local') ) {
                $translations->flush($locale);
            }

            return $translations->getAll($locale)->toArray();
        };
    }
}
