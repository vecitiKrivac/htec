<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\FileRequest;
use App\Http\Resources\Route\RouteResource;
use App\Http\Services\FileService;
use App\Http\Services\RouteService;
use Illuminate\Support\Facades\Log;

class RouteController extends AppBaseController
{
    public function store(FileRequest $request, FileService $fileService, RouteService $routeService)
    {
        try {
            $file = $fileService->create($request, 'route');
            $routes = $routeService->insert($file);

            if (count($routes) > 0) {
                return $this->sendResponse(
                    RouteResource::collection($routes),
                    'Routes added successfully',
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
}
