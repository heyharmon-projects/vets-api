<?php

namespace DDD\App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;
use DDD\Domain\Locations\Commands\ImportFromYelp;
use DDD\Domain\Locations\Commands\GetScreenshotsCommand;
use DDD\Domain\Locations\Commands\GetFaviconsCommand;
use DDD\Domain\Locations\Commands\GetCoordinatesCommand;
use DDD\Domain\Locations\Commands\EnrichFromUtahDWS;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        EnrichFromUtahDWS::class,
        ImportFromYelp::class,
        GetFaviconsCommand::class,
        GetScreenshotsCommand::class,
        GetCoordinatesCommand::class,
    ];

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
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
