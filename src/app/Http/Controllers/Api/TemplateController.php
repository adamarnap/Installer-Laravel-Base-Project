<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Api\AuthService;
use App\Http\Resources\Api\Auth\LoginResource;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {}

    /**
     * Login & generate token
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->authService->login($validated);
        $result = LoginResource::make($user);
        return ApiResponse::success(data: $result, message: 'Login successful');
    }
}