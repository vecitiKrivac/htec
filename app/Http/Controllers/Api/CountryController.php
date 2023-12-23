<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Country\CountryCollection;
use App\Http\Services\CountryService;

class CountryController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(CountryService $service)
    {
        $countries = $service->getCountries();

        return $this->sendResponse(
            new CountryCollection($countries),
            'Countries retrieved successfully',
            true,
            200,
            'countries'
        );
    }
}
