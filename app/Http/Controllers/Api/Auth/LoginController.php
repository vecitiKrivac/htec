<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Auth\LoginUser;
use App\Http\Resources\Auth\UserResource;
use App\Http\Services\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends AppBaseController
{
    use AuthenticatesUsers;

    public function login(LoginUser $request, UserService $service)
    {
        if ($data = $service->login($request)) {

            return $this->sendResponse([
                'user' => new UserResource($data['user']),
                'token' => $data['token']
            ], 'User is logged successfully.');
        }

        return $this->sendError('Unauthorized', 401);
    }
}
