<?php

namespace App\Http\Services;

use App\Models\City;
use Illuminate\Support\Facades\DB;

class CityService
{
    public function create($request)
    {
        try {
            return City::create([
                'country_id' => $request['country_id'],
                'name' => $request['name'],
                'description' => $request['description']
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, $request)
    {
        try {
            $city = $this->getCity($id);

            if ($city) {
                $city->fill($request);
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
                $city->airports()->delete();
                $city->comments()->delete();
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

    public function getCities($request)
    {
        $cities = City::with(['country', 'comments' => function ($query) use ($request) {
            $query->latest();
            if (isset($request['counter_per_record'])) {
                $query->limit($request['counter_per_record']);
            }
        }, 'comments.user']);

        if (isset($request['city'])) {
            $cities->where('name', 'like', "%{$request['city']}%");
        }

        return $cities->orderBy('name')->get();
    }
}
