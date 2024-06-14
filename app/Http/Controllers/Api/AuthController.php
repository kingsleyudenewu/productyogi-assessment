<?php

namespace App\Http\Controllers\Api;

use App\Actions\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        $action->execute($request->only(['name', 'email', 'password']));

        return $this->createdResponse('User registered successfully');
    }
}
