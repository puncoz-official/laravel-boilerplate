<?php

namespace App\Application\Commands;

use App\Libraries\Translations\TranslationCaching;
use Illuminate\Console\Command;

/**
 * Class CacheTranslations
 *
 * @package App\Application\Commands'
 */
class CacheTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache all translations.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(TranslationCaching $translationCaching)
    {
        $translationCaching->cacheAll();

        $this->info('Translations cached.');
    }
}
