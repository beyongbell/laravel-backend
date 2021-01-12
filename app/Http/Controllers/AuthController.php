<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create($request->validated());
        return new UserResource($user);
    }
}
