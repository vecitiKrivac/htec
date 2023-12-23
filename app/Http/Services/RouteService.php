<?php

namespace App\Http\Services;

use App\Models\Route;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RouteService
{
    protected $airportService;

    public function __construct(AirportService $airportService)
    {
        $this->airportService = $airportService;
    }

    public function insert($file)
    {
        $routes = $this->getRoutesByAirlineId();
        $airports = $this->airportService->getAirportsById();
        $content = array_map('str_getcsv', file($file->file_path));
        $now = Carbon::now()->toDateTimeString();
        $data = [];
        $dataCollection = collect();

        try {
            DB::beginTransaction();

            foreach ($content as $key => $val) {
                $airlineID = (is_numeric($val[1])) ? $val[1] : null;

                if (($airports->has($val[3]) && $airports->has($val[5])) && (!$routes->has($airlineID))) {
                    $routeData = [
                        'airline' => $val[0],
                        'airline_id' => $airlineID,
                        'source_airport_id' => $val[3],
                        'destination_airport_id' => $val[5],
                        'codeshare' => $val[6],
                        'stops' => $val[7],
                        'equipment' => $val[8],
                        'price' => $val[9],
                        'created_at' => $now,
                        'updated_at' => $now
                    ];

                    $data[] = $routeData;
                    $dataCollection->push(new Route($routeData));
                }
            }

            if (is_array($data) && (count($data) > 0)) {
                $dataCunk = array_chunk($data, 100);
                foreach ($dataCunk as $cunk) {
                    Route::insert($cunk);
                }
            }

            DB::commit();

            return $dataCollection;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getRoutesByAirlineId()
    {
        return Route::All()->keyBy('airline_id');
    }
}
