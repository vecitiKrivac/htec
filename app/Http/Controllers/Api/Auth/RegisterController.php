<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\RegisterUser;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends AppBaseController
{
    public function register(RegisterUser $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken('personalToken');

        return $this->sendResponse([
            'user' => new UserResource($user),
            'token' => $token->plainTextToken
        ], 'User is registered successfully.', true, 201);
    }
}
