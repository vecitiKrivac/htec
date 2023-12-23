<?php

namespace App\Http\Services;

use App\Models\Airport;
use Illuminate\Support\Facades\DB;

class AirportService
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    public function insert($file)
    {
        $airports = $this->getAirportsById();
        $cities = $this->cityService->getCitiesName();
        $content = array_map('str_getcsv', file($file->file_path));
        $now = now();
        $data = [];
        $dataCollection = collect();

        try {
            DB::beginTransaction();

            foreach ($content as $key => $val) {
                if (($cities->has($val[2])) && !($airports->has($val[0]))) {
                    $airportData = [
                        'id' => $val[0],
                        'city_id' => $cities[$val[2]],
                        'name' => $val[1],
                        'iata' => $val[4],
                        'icao' => $val[5],
                        'latitude' => $val[6],
                        'longitude' => $val[7],
                        'altitude' => $val[8],
                        'time_zone_utc' => (is_numeric($val[9])) ? $val[9] : null,
                        'dst' => (strlen($val[10]) == 1) ? $val[10] : null,
                        'time_zone_type' => ($val[11] != '\N') ? $val[11] : null,
                        'source' => $val[12] . ' ' . $val[13],
                        'created_at' => $now,
                        'updated_at' => $now
                    ];
                    $data[] = $airportData;
                    $dataCollection->push(new Airport($airportData));
                }
            }

            if (is_array($data) && (count($data) > 0)) {
                $dataCunk = array_chunk($data, 100);
                foreach ($dataCunk as $cunk) {
                    Airport::insert($cunk);
                }
            }

            DB::commit();

            return $dataCollection;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getAirportsById()
    {
        return Airport::All()->keyBy('id');
    }
}
