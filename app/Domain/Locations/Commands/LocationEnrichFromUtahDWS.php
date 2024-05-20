<?php

namespace DDD\Domain\Locations\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;

class LocationEnrichFromUtahDWS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locations:enrich-from-utah-dws';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enrich locations with data from Utah DWS.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $records = json_decode(File::get('storage/app/locations/utah-dws_2023-12-13.json'), true);

        $locations = Location::all();
        
        foreach ($locations as $index => $location) {
            // Only enrich 6 locations for now
            // if ($index > 5) {
            //     break;
            // }

            foreach ($records as $record) {
                // Match location by latitude and longitude
                if ($location->latitude == $record['Latitude'] && $location->longitude == $record['Longitude']) {
                    // add employees to location
                    $location->employees = $record['Employees'];

                    // if phones don't match assume phone is owners
                    if ($location->phone != $record['Phone']) {
                        $location->phone_owner = $record['Phone'];
                    }

                    $location->save();
                }
            }
        }

        $this->info('Locations enriched.');
    }
}
