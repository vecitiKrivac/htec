<?php

namespace App\Http\Services;

use App\Models\Country;

class CountryService
{
    public function getCountries()
    {
        return Country::orderBy('name', 'asc')->get();
    }
}
