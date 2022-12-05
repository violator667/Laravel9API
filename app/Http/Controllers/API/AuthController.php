<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\ApiAuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private object $controllerService;

    public function __construct(ApiAuthService $service)
    {
        $this->controllerService = $service;
    }

    public function createUser(UserRegisterRequest $request) :JsonResponse
    {
        return $this->controllerService->createUser($request);
    }

    public function loginUser(UserLoginRequest $request) :JsonResponse
    {
        return $this->controllerService->loginUser($request);
    }
}
