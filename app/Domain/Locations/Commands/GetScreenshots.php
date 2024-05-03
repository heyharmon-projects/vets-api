<?php

namespace DDD\Domain\Locations\Commands;

use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;
use DDD\Domain\Locations\Actions\TakeLocationScreenshotAction;

class GetScreenshots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locations:get-screenshots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take a screenshot for all locations with a missing screenshot.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locations = Location::whereNull('screenshot_file_id')->get();
        
        foreach ($locations as $location) {
            TakeLocationScreenshotAction::dispatch($location);
        }

        $this->info('Screenshot jobs dispatched.');
    }
}
