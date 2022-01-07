<?php

namespace App\Infrastructure\Kernels;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;

/**
 * Class ConsoleKernel
 *
 * @package App\Infrastructure\Kernels
 */
class ConsoleKernel extends Kernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/../../Application/Console');

        require base_path('routes/console.php');
    }
}
