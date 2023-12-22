<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\LoginUser;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends AppBaseController
{
    use AuthenticatesUsers;

    public function login(LoginUser $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('personalToken');

            return $this->sendResponse([
                'user' => new UserResource($user),
                'token' => $token->plainTextToken
            ], 'User is logged successfully.');
        } else {
            return $this->sendError('Unauthorized', 401);
        }
    }
}
