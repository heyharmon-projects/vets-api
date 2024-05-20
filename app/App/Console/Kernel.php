<?php

namespace DDD\App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;
use DDD\Domain\Locations\Commands\LocationLinkedInUrl;
use DDD\Domain\Locations\Commands\LocationImportFromYelp;
use DDD\Domain\Locations\Commands\LocationGetScreenshotsCommand;
use DDD\Domain\Locations\Commands\LocationGetFaviconsCommand;
use DDD\Domain\Locations\Commands\LocationGetCoordinatesCommand;
use DDD\Domain\Locations\Commands\LocationEnrichFromUtahDWS;
use DDD\Domain\Contacts\Commands\ContactLinkedInEmployees;
use DDD\Domain\Contacts\Commands\ContactLinkedIn;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Locations
        LocationEnrichFromUtahDWS::class,
        LocationImportFromYelp::class,
        LocationGetFaviconsCommand::class,
        LocationGetScreenshotsCommand::class,
        LocationGetCoordinatesCommand::class,
        LocationLinkedInUrl::class,

        // Contacts
        ContactLinkedIn::class,
        ContactLinkedInEmployees::class,
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
