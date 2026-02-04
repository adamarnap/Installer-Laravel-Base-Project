<?php

namespace App\Http\Services\Api\Mobile;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ServiceException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /** 
     * POST: Login & generate token
     */
    public function login(array $data)
    { 
        try {
            // Start DB Transaction
            DB::beginTransaction();

            // Get user by email
            $user = User::where('email', $data['email'])->first();

            // Check user & password
            if (!$user || !Hash::check($data['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            // Create token
            // Optional add device name or identifier
            $tokenName = $data['device_name'] ?? 'api-token';
            $token = $user->createToken(
                        name: $tokenName,
                        abilities: ['*'],
                        expiresAt: now()->addDays(config('sanctum.expiration', 30))
                    );

            // Commit Transaction
            DB::commit();

            // Return user with token
            $user->api_token = $token->plainTextToken;
            $user->expires_at = $token->accessToken->expires_at->toDateTimeString();
            return $user;
        } catch (ServiceException $e) {
            DB::rollBack();
            throw $e;
        } catch (Throwable $th) {
            // Rollback Transaction
            DB::rollBack();
            throw new ServiceException(
                message: $th->getMessage(),
                code: 500,
                context: [
                'error' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
                ]
            );
        }
    }

    /** 
     * POST: Change password
     */
    public function changePassword(array $data, $user)
    {
        try {
            // Start DB Transaction
            DB::beginTransaction();

            // Check current password with user password
            if (!Hash::check($data['current_password'], $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['The current password is incorrect.'],
                ]);
            }

            // Update user password
            $user->update([
                'password' => Hash::make($data['new_password']),
            ]);

            return true;

            // Commit Transaction
            DB::commit();
        } catch (ServiceException $e) {
            DB::rollBack();
            throw $e;
        } catch (Throwable $th) {
            // Rollback Transaction
            DB::rollBack();
            throw new ServiceException(
                message: $th->getMessage(),
                code: 500,
                context: [
                'error' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine()
                ]
            );
        }
    }
}

