<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\FileRequest;
use App\Http\Resources\Airport\AirportResource;
use App\Http\Services\AirportService;
use App\Http\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AirportController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        die('index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FileRequest $request, FileService $fileService, AirportService $airportService)
    {
        try {
            $file = $fileService->create($request, 'airport');
            $airports = $airportService->insert($file);

            if (count($airports) > 0) {
                return $this->sendResponse(
                    AirportResource::collection($airports),
                    'Airports added successfully',
                    true,
                    201
                );
            } else {
                return $this->sendError('Invalid data', 422);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->sendError('An error occurred while saving the data', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
