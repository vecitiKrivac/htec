<?php

namespace App\Http\Services;

use App\Http\Helper\FlightsGraph;

class FlightService
{
    protected $routeService;
    protected $airportService;

    public function __construct(RouteService $routeService, AirportService $airportService)
    {
        $this->routeService = $routeService;
        $this->airportService = $airportService;
    }

    public function getFlights($request)
    {
        $graph = new FlightsGraph($this->routeService->getAllRoutes());

        $routes = $graph->search($request['source_airport_id'], $request['destination_airport_id']); //3, 4
        $prices = $graph->prices($routes);

        return $this->getFlightsData($routes, $prices);
    }

    private function getFlightsData($routes, $prices)
    {
        if ($routes) {
            $airports = $this->airportService->getAirportsById('city');

            asort($prices);
            foreach ($prices as $key => $val) {
                $data[] = [
                    'price' => number_format($val, 2),
                    'route' => $this->getRouteAirports($routes[$key], $airports)
                ];
            }

            return $data;
        }

        return false;
    }

    private function getRouteAirports($path, $airports)
    {
        foreach ($path as $key => $airportId) {
            $data[$key] = $airports[$airportId]->city->name;
        }

        return $data;
    }
}
