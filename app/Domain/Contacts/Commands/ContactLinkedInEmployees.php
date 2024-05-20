<?php

namespace DDD\Domain\Contacts\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use DDD\Domain\Locations\Location;
use DDD\Domain\Contacts\Contact;

class ContactLinkedInEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contacts:linkedin-employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import contacts from linkedin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rows = json_decode(File::get('storage/app/contacts/contacts-linkedin-employees-of-companies.json'), true);
        
        foreach ($rows as $index => $row) {
            $location = Location::where('linkedin_url', $row['location_linkedin'])->first();

            if ($location) {
                $contact = Contact::firstOrCreate(
                    ['linkedin_url' =>  $row['linkedin']],
                    [
                        'user_id' => 1,
                        'location_id' => $location->id,
                        'name' => $row['name'],
                        'title' => $row['title'],
                        'linkedin_url' => $row['linkedin'],
                    ]
                );
            }
        }

        $this->info('Data imported successfully.');
    }
}
