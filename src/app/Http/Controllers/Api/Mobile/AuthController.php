<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Api\Mobile\AuthService;
use App\Http\Resources\Api\Mobile\Auth\LoginResource;

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

    /**
     * Logout - Revoke token
     */
    public function logout(Request $request)
    {
        // Delete current token
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::success(message: 'Logged out successfully');
    }

    /**
     * Logout from all devices
     */
    public function logoutAll(Request $request)
    {
        // Delete all user tokens
        $request->user()->tokens()->delete();
        return ApiResponse::success(message: 'Logged out from all devices successfully');
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
        ]);

        $user = $request->user();

        $changePassowrd = $this->authService->changePassword($validated, $user);
        return ApiResponse::success(message: 'Password changed successfully');
    }
}
