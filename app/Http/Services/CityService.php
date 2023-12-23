<?php

namespace App\Http\Services;

use App\Http\Requests\Api\City\CityRequest;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class CityService
{
    public function create(CityRequest $request)
    {
        try {
            return City::create([
                'country_id' => $request->input('country_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, CityRequest $request)
    {
        try {
            $city = $this->getCity($id);

            if ($city) {
                $city->fill($request->all());
                $city->save();

                return $city;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $city = $this->getCity($id);

            if ($city) {
                // $city->airports()->delete();
                // $city->comments()->delete();
                $city->delete();
                DB::commit();

                return $city;
            }
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getCity($id)
    {
        return City::find($id);
    }

    public function getCitiesName()
    {
        return City::all()->pluck('id', 'name');
    }
}
