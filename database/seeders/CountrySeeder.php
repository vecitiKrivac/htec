<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($data = $this->getData()) {
            $chunks = array_chunk($data, 100);
            foreach ($chunks as $chunk) {
                Country::insert($chunk);
            }
        }
    }

    private function getData()
    {
        if ($content = $this->parseCsv()) {
            $data = [];
            $time = now();
            foreach ($content as $val) {
                if (!array_key_exists($val[3], $data)) {
                    $data[$val[3]] = [
                        'name' => $val[3],
                        'created_at' => $time,
                        'updated_at' => $time
                    ];
                }
            }

            return $data;
        }

        return false;
    }

    private function parseCsv()
    {
        $filePath = storage_path('app/init/airports.csv');
        if (File::exists($filePath)) {
            return array_map('str_getcsv', file($filePath));
        }

        $this->command->error('file doesnt exist');
        return false;
    }
}
