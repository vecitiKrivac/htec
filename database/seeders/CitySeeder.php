<?php

namespace Database\Seeders;

use App\Http\Services\CountryService;
use App\Models\City;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Seeder;

class CitySeeder extends FileParserSeeder
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($data = $this->getData()) {
            $chunks = array_chunk($data, 100);
            foreach ($chunks as $chunk) {
                City::insert($chunk);
            }
        }
    }

    private function getData()
    {
        $countries = $this->countryService->getCountries()->pluck('id', 'name');

        if ((count($countries) > 0) && $content = $this->parseCsv()) {
            $data = [];
            $time = now();

            foreach ($content as $val) {

                if ($val[2] != '' && !array_key_exists($val[2], $data)) {
                    $data[$val[2]] = [
                        'country_id' => $countries[$val[3]],
                        'name' => $val[2],
                        'description' => '',
                        'created_at' => $time,
                        'updated_at' => $time
                    ];
                }
            }

            return $data;
        }

        return false;
    }
}
