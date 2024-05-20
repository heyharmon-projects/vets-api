<?php

namespace DDD\Domain\Locations\Commands;

use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;
use DDD\Domain\Locations\Actions\GetFaviconAction;

class LocationGetFaviconsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locations:get-favicons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a favicon for all locations with a missing favicon.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locations = Location::whereNull('favicon_file_id')->get();
        
        foreach ($locations as $location) {
            GetFaviconAction::dispatch($location);
        }

        $this->info('Favicon jobs dispatched.');
    }
}
