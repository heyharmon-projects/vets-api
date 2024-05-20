<?php

namespace DDD\Domain\Locations\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;

class LocationLinkedInUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locations:linkedin-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enrich locations with LinkedIn url.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rows = json_decode(File::get('storage/app/locations/location-linkedin-urls.json'), true);
        
        foreach ($rows as $index => $row) {
            // Only import 6 locations for now
            // if ($index > 5) {
            //     break;
            // }

            $location = Location::find($row['location_id']);

            if ($location) {
                $location->linkedin_url = $row['linkedin_url'];
                $location->save();
            }
        }

        $this->info('Data imported successfully.');
    }
}
