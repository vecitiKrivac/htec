<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Auth\RegisterUser;
use App\Http\Resources\Auth\UserResource;
use App\Http\Services\UserService;

class RegisterController extends AppBaseController
{

    public function register(RegisterUser $request, UserService $service)
    {
        $data = $service->register($request);

        return $this->sendResponse([
            'user' => new UserResource($data['user']),
            'token' => $data['token']
        ], 'User is registered successfully.', true, 201);
    }
}
