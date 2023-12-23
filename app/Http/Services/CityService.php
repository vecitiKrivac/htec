<?php

namespace App\Http\Services;

use App\Http\Requests\Api\City\CityRequest;
use App\Models\City;

class CityService
{
    public function create(CityRequest $request)
    {
        return City::create([
            'country_id' => $request->input('country_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
    }

    public function update($id, CityRequest $request)
    {
        $city = $this->getCity($id);

        if ($city) {
            $city->fill($request->all());
            $city->save();

            return $city;
        }

        return false;
    }

    public function destroy($id)
    {
        $city = $this->getCity($id);

        if ($city) {
            var_dump($city);
            die;
            // $city->airports()->delete();
            // $city->comments()->delete();
            $city->delete();
        }

        return false;
    }

    public function getCity($id)
    {
        return City::find($id);
    }
}
