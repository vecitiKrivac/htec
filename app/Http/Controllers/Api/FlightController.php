<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\FlightRequest;
use App\Http\Services\FlightService;

class FlightController extends AppBaseController
{
    public function index(FlightRequest $request, FlightService $flightService)
    {
        return $this->sendResponse(
            $flightService->getFlights($request->all()),
            'Flight routes retrived successfully'
        );
    }
}
