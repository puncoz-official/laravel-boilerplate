<?php

namespace App\Application\Commands;

use App\Libraries\Translations\TranslationCaching;
use Illuminate\Console\Command;

/**
 * Class FlushTranslations
 *
 * @package App\Application\Commands
 */
class FlushTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush all translations cache.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(TranslationCaching $translationCaching)
    {
        $translationCaching->flushAll();

        $this->info('All translations cache has been flushed.');
    }
}
