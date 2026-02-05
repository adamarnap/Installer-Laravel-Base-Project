<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecaptchaRule implements ValidationRule
{
    protected $minScore;

    public function __construct($minScore = 0.5)
    {
        $this->minScore = $minScore;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip validation jika reCAPTCHA disabled
        if (!config('recaptcha.enabled', false)) {
            Log::info('reCAPTCHA validation skipped - disabled in config');
            return;
        }

        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => config('recaptcha.secret_key'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ]
        );

        $result = $response->json();

        // Log untuk debugging
        Log::info('reCAPTCHA v3 Response:', $result);

        // Cek apakah verifikasi berhasil
        if (!($result['success'] ?? false)) {
            $fail('Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            return;
        }

        // Cek score (v3 specific)
        $score = $result['score'] ?? 0;
        if ($score < $this->minScore) {
            $fail('Verifikasi keamanan gagal. Silakan coba lagi.');
            Log::warning('reCAPTCHA score too low', ['score' => $score, 'ip' => request()->ip()]);
        }
    }
}
