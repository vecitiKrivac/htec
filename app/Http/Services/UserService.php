<?php

namespace App\Http\Services;

use App\Http\Requests\Api\Auth\LoginUser;
use App\Http\Requests\Api\Auth\RegisterUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserService
{
    use RegistersUsers;

    public function __construct()
    {
    }

    public function register(RegisterUser $request)
    {
        event(new Registered($user = $this->store($request->all())));

        $this->guard()->login($user);

        return [
            'user' => $user,
            'token' => $this->getToken($user)
        ];
    }

    public function login(LoginUser $request)
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password . $user->salt, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return [
            'user' => $user,
            'token' => $this->getToken($user)
        ];
    }

    private function store(array $data)
    {
        $salt = Str::random(16);

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password'] . $salt),
            'salt' => $salt,
            'admin' => 0
        ]);
    }

    private function getToken($user, $name = 'personalToken')
    {
        return $user->createToken($name)->plainTextToken;
    }
}
