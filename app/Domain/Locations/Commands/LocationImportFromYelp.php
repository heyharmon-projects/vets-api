<?php

namespace DDD\Domain\Locations\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;

class LocationImportFromYelp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locations:import-from-yelp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import locations from Yelp.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $locations = json_decode(File::get('storage/app/locations/utah-yelp_2023-12-13.json'), true);
        
        foreach ($locations as $index => $location) {
            // Only import 6 locations for now
            // if ($index > 5) {
            //     break;
            // }
            
            $location = Location::create([
                'title' => $location['name'],
                'phone' => $location['phone'],
                'website' => $location['website'],
                // 'primary_image_url' => $location['primary_image_url'],
                'address_line_1' => $location['address']['addressLine1'],
                'address_line_2' => $location['address']['addressLine2'],
                'city' => $location['address']['city'],
                'state' => $location['address']['regionCode'],
                'postal_code' => $location['address']['postalCode'],
                'country' => $location['address']['country'],
                'yelp_url' => $location['directUrl'],
            ]);
        }

        $this->info('Data imported successfully.');
    }
}
