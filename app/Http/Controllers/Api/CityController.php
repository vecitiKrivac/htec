<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\City\CityRequest;
use App\Http\Services\CityService;

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
        $this->sendResponse($city, 'City added successfully', true, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id, CityService $service)
    {
        $city = $service->update($id, $request);
        $this->sendResponse($city, 'City updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, CityService $service)
    {
        $city = $service->destroy($id);
        $this->sendResponse($city, 'City updated successfully');
    }
}
