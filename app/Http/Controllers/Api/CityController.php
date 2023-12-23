<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\City\CityRequest;
use App\Http\Requests\Api\City\CitySearchRequest;
use App\Http\Resources\City\CityResource;
use App\Http\Resources\City\CitySearchResource;
use App\Http\Services\CityService;
use Illuminate\Support\Facades\Log;

class CityController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(CitySearchRequest $request, CityService $service)
    {
        try {
            $cities = $service->getCities($request->all());
            return $this->sendResponse(
                CitySearchResource::collection($cities),
                'City data retrived successfully'
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->sendError('An error occurred while saving the data', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request, CityService $service)
    {
        try {
            return $this->sendResponse(
                new CityResource($service->create($request)),
                'City added successfully',
                true,
                201
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->sendError('An error occurred while saving the data', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, CityService $service)
    {
        if ($city = $service->getCity($id)) {
            return $this->sendResponse(
                new CityResource($city),
                'City retrived successfully'
            );
        }

        return $this->sendError('Resource not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, CityRequest $request, CityService $service)
    {
        if ($city = $service->update($id, $request)) {
            return $this->sendResponse(
                new CityResource($city),
                'City updated successfully'
            );
        }

        return $this->sendError('Resource not found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, CityService $service)
    {
        try {
            if ($city = $service->destroy($id)) {
                return $this->sendResponse(
                    new CityResource($city),
                    'City deleted successfully'
                );
            }
            return $this->sendError('Resource not found');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->sendError('An error has occurred in the database', 500);
        }
    }
}
