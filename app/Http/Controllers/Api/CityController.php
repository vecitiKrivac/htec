<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\City\CityRequest;
use App\Http\Resources\City\CityResource;
use App\Http\Services\CityService;
use Database\Seeders\CitySeeder;
use Illuminate\Http\Request;

class CityController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        die('display cities');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request, CityService $service)
    {
        $city = $service->create($request);

        // TODO add CityResource
        return $this->sendResponse(
            new CityResource($city),
            'City added successfully',
            true,
            201
        );
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
        if ($city = $service->destroy($id)) {
            return $this->sendResponse(
                new CityResource($city),
                'City deleted successfully'
            );
        }

        return $this->sendError('Resource not found');
    }
}
