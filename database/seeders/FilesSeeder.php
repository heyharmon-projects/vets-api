<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Flynsarmy\CsvSeeder\CsvSeeder;

class FilesSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'files';
		$this->filename = base_path().'/database/seeds/files.csv';
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
