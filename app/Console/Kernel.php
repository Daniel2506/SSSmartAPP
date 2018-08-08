<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        \App\Console\Commands\Facturas::class,
        \App\Console\Commands\Bitacoras::class,
        \App\Console\Commands\Finalizados::class,
        \App\Console\Commands\Monedas::class,
        \App\Console\Commands\MonedasCofre::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('facturas:import')->hourly();
        $schedule->command('bitacoras:import')->hourly();
        $schedule->command('finalizados:import')->hourly();
        $schedule->command('monedas:import')->hourly();
        $schedule->command('monedascofre:import')->hourly();
    }

    /**
    * Register the Closure based commands for the application.
    *
    * @return void
    */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
