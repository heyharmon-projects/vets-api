<?php

namespace DDD\Domain\Contacts\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use DDD\Domain\Contacts\Contact;

class ContactLinkedIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contacts:linkedin';

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
        $rows = json_decode(File::get('storage/app/contacts/contacts-linkedin.json'), true);
        
        foreach ($rows as $index => $row) {
            // Only import 6 locations for now
            // if ($index > 5) {
            //     break;
            // }

            Contact::create([
                'user_id' => 1,
                'location_id' => $row['location_id'],
                'name' => $row['name'],
                'title' => $row['title'],
                'years' => !empty($row['years']) ? $row['years'] : null,
                'linkedin_url' => $row['href'],
            ]);
        }

        $this->info('Data imported successfully.');
    }
}
