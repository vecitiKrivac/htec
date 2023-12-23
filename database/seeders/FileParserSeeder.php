<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FileParserSeeder extends Seeder
{
    public function parseCsv($fileName = 'app/init/airports.csv')
    {
        $filePath = storage_path($fileName);
        if (File::exists($filePath)) {
            return array_map('str_getcsv', file($filePath));
        }

        $this->command->error("File '$fileName' doesn't exist");
        return false;
    }
}
