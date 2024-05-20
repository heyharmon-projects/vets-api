<?php

namespace DDD\Domain\Locations\Commands;

use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;
use DDD\Domain\Locations\Actions\GetCoordinatesAction;

class LocationGetCoordinatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locations:get-coordinates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get lat/long coordinates for all locations with missing coordinates.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locations = Location::whereNull('latitude')->get();
         
        foreach ($locations as $location) {
            GetCoordinatesAction::dispatch($location);
        }

        $this->info('Coordinates jobs dispatched.');
    }
}
