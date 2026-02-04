<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Enums\JenisKelaminEnum;
use App\Enums\JenisPendidikanEnum;
use App\Http\Controllers\Controller;
use App\Http\Services\Api\Mobile\ProfileService;
use App\Http\Resources\Api\Mobile\Profile\UserProfileResource;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService)
    {}

    /** 
     * GET: User Profile
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $profile = $this->profileService->getProfile($user);
        $result = UserProfileResource::make($profile);
        return ApiResponse::success(data: $result, message: 'User profile retrieved successfully');
    }

    /** 
     * PUT: Update User Profile
     */
    public function update(Request $request)
    {
        $validatedUserData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $validatedUserProfileData = $request->validate([
            'nomor_identitas' => 'sometimes|required|numeric|digits:16|unique:users_profile,nomor_identitas,' . $request->user()->profile->id . ',id',
            'ponsel' => 'sometimes|required|min:9|max:13|unique:users_profile,ponsel,' . $request->user()->profile->id,
            'has_npwp' => 'sometimes|required|boolean',
            'jenis_kelamin' => 'sometimes|required|in:' . implode(',', array_column(JenisKelaminEnum::cases(), 'value')),
            'tempat_lahir' => 'sometimes|required|string|max:50',
            'tanggal_lahir' => 'sometimes|required|date',
            'alamat' => 'sometimes|required|string|max:500',
            'pendidikan' => 'sometimes|nullable|in:' . implode(',', array_column(JenisPendidikanEnum::cases(), 'value')),
            'pekerjaan' => 'sometimes|nullable|string|max:50',
            'instansi' => 'sometimes|nullable|string|max:50',
        ]);

        $newProfile = $this->profileService->updateProfile(userData: $validatedUserData, userProfileData: $validatedUserProfileData, user: $request->user());
        $result = UserProfileResource::make($newProfile);
        return ApiResponse::success(data: $result, message: 'User profile updated successfully');
    }

    /** 
     * PUT: Update User Profile Photo
     */
    public function updateProfilePhoto(Request $request)
    {        
        $validated = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $updatedProfilePhoto = $this->profileService->updateProfilePhoto(profilePhotoFile: $validated['avatar'], user: $request->user());
        return ApiResponse::success(data: $updatedProfilePhoto, message: 'User profile photo updated successfully');
    }

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
