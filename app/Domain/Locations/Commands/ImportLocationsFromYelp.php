<?php

namespace DDD\Domain\Locations\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;

class ImportLocationsFromYelp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:locations-from-yelp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import locations from Yelp';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $jsonFilePath = $this->argument('file');

        // if (!File::exists($jsonFilePath)) {
        //     $this->error('JSON file not found.');
        //     return;
        // }

        $locations = json_decode(File::get('storage/app/locations/yelp-utah-veterinarian_2023-12-13.json'), true);
        
        foreach ($locations as $location) {
            Location::create([
                'name' => $location['name'],
                'phone' => $location['phone'],
                'website' => $location['website'],
                // 'primary_image_url' => $location['primary_image_url'],

                'address_line_1' => $location['address']['addressLine1'],
                'address_line_2' => $location['address']['addressLine2'],
                'city' => $location['address']['city'],
                'state' => $location['address']['regionCode'],
                'postal_code' => $location['address']['postalCode'],
                'country' => $location['address']['country'],

                
            ]);
        }

        $this->info('Data imported successfully.');
    }
}
