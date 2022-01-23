<?php

namespace App\Libraries\Translations;

use Illuminate\Cache\CacheManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

/**
 * Class TranslationCaching
 *
 * @package App\Libraries\Translations
 */
class TranslationCaching
{
    public function getAll(string $locale): Collection
    {
        return (new CacheManager(app()))->rememberForever($this->getCacheKey($locale), function () use ($locale) {
            $files = File::files(resource_path("lang/{$locale}"));

            return collect($files)
                ->map(fn($file) => [$file->getFilenameWithoutExtension() => require($file)])
                ->collapse();
        });
    }

    public function cacheAll(): void
    {
        collect($this->availableLocales())->each(function (string $locale) {
            $this->getAll($locale);
        });
    }

    public function flush(string $locale): void
    {
        (new CacheManager(app()))->forget($this->getCacheKey($locale));
    }

    public function flushAll(): void
    {
        collect($this->availableLocales())->each(function (string $locale) {
            $this->flush($locale);
        });
    }

    protected function availableLocales(): array
    {
        return collect(File::directories(resource_path('lang')))->map(fn($path) => basename($path))->toArray();
    }

    protected function getCacheKey(string $locale): string
    {
        return sprintf('lang-%s.js', $locale);
    }
}
