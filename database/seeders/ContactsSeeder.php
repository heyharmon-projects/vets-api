<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Flynsarmy\CsvSeeder\CsvSeeder;

class ContactsSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'contacts';
		$this->filename = base_path().'/database/seeds/contacts.csv';
	}
    
    public function run(): void
    {
        // Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		// DB::table($this->table)->truncate();

		parent::run();
    }
}
