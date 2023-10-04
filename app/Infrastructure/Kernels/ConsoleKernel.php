<?php

namespace App\Infrastructure\Kernels;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;

/**
 * Class ConsoleKernel
 */
class ConsoleKernel extends Kernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(app_path('Application/Console'));

        require base_path('routes/console.php');
    }
}
