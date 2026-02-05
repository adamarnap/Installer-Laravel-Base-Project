<?php

namespace App\Http\Services\Api\Mobile;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ServiceException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /** 
     * POST: Login & generate token
     */
    public function login(array $data)
    { 
        try {
            // Rate Limiter Check (SEBELUM DB Transaction!)
            $throttleKey = Str::lower($data['email']).'|'.request()->ip();
            $maxAttempts = config('rate_limiter.max_attempts', 5);

            // Debug logging
            Log::info('Rate Limiter Check', [
                'key' => $throttleKey,
                'max_attempts' => $maxAttempts,
                'current_attempts' => RateLimiter::attempts($throttleKey),
                'remaining' => RateLimiter::remaining($throttleKey, $maxAttempts)
            ]);

            if(RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                
                Log::warning('Rate limit exceeded', [
                    'key' => $throttleKey,
                    'seconds_remaining' => $seconds
                ]);
                
                throw ValidationException::withMessages([
                    'email' => ['Too many login attempts. Please try again in '.$seconds.' seconds.'],
                ]);
            }

            // Start DB Transaction (SETELAH rate limiter check)
            DB::beginTransaction();

            // Get user by email
            $user = User::where('email', $data['email'])->first();

            // Check user & password
            if (!$user || !Hash::check($data['password'], $user->password)) {
                // Commit dulu sebelum throw exception
                DB::rollBack();
                
                // Hit Rate Limiter when failed login (DILUAR transaction)
                $blockTime = 60 * config('rate_limiter.decay_minutes', 1);
                RateLimiter::hit($throttleKey, $blockTime);

                Log::warning('Failed login attempt', [
                    'key' => $throttleKey,
                    'attempts_after_hit' => RateLimiter::attempts($throttleKey),
                    'block_time' => $blockTime
                ]);

                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            // Clear Rate Limiter on successful login (SEBELUM commit)
            RateLimiter::clear($throttleKey);
            
            Log::info('Successful login, rate limiter cleared', [
                'key' => $throttleKey,
                'email' => $data['email']
            ]);

            // Create token
            // Optional add device name or identifier
            $tokenName = $data['device_name'] ?? 'api-token';
            $tokenExpirationMinutes = (int) config('sanctum.expiration', 43800); // Default 30 days in minutes
            $token = $user->createToken(
                        name: $tokenName,
                        abilities: ['*'],
                        expiresAt: now()->addMinutes($tokenExpirationMinutes)
                    );

            // Commit Transaction
            DB::commit();

            // Return user with token
            $user->api_token = $token->plainTextToken;
            $user->expires_at = $token->accessToken->expires_at->toDateTimeString();
            return $user;
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
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

            // Commit Transaction
            DB::commit();

            return true;
        } catch (ValidationException $e) {
            DB::rollBack();
            throw $e;
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

