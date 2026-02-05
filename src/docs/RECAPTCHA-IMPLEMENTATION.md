# Panduan Implementasi Google reCAPTCHA v3

Dokumentasi implementasi Google reCAPTCHA v3 pada sistem login aplikasi KDMP.

## Daftar Isi
1. [Pendaftaran reCAPTCHA](#1-pendaftaran-recaptcha)
2. [Konfigurasi](#2-konfigurasi)
3. [Implementasi](#3-implementasi)
4. [Testing](#4-testing)
5. [Troubleshooting](#5-troubleshooting)

## 1. Pendaftaran reCAPTCHA

Buka https://www.google.com/recaptcha/admin dan login dengan akun Google. Register site baru dengan konfigurasi:
- **Label**: KDMP Bantul
- **Type**: reCAPTCHA v3
- **Domains**: localhost, 127.0.0.1, yourdomain.com

Setelah submit, copy **Site Key** (untuk frontend) dan **Secret Key** (untuk backend).

## 2. Konfigurasi

Tambahkan keys ke file `.env`:

```env
RECAPTCHA_SITE_KEY=your_site_key_here
RECAPTCHA_SECRET_KEY=your_secret_key_here
RECAPTCHA_ENABLED=true
RECAPTCHA_MIN_SCORE=0.5
```

**RECAPTCHA_ENABLED**: 
- `true` = reCAPTCHA aktif (production)
- `false` = reCAPTCHA dimatikan (development/testing)

**RECAPTCHA_MIN_SCORE**: Threshold score (0.0 - 1.0)
- `0.5` = balanced (recommended)
- `0.7` = strict
- `0.3` = permisive

Config file di `config/recaptcha.php`:

```php
<?php 
return [
    'site_key' => env('RECAPTCHA_SITE_KEY'),
    'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    'enabled' => env('RECAPTCHA_ENABLED', false),
    'min_score' => env('RECAPTCHA_MIN_SCORE', 0.5),
];
```

## 3. Implementasi

### Controller

File: `app/Http/Controllers/Auth/AuthenticatedSessionController.php`

```php
public function store(LoginRequest $request): RedirectResponse
{
    // Validasi reCAPTCHA v3 jika enabled
    if (config('recaptcha.enabled', false)) {
        $request->validate([
            'g-recaptcha-response' => ['required', new RecaptchaRule(config('recaptcha.min_score', 0.5))],
        ], [
            'g-recaptcha-response.required' => 'Verifikasi keamanan gagal. Silakan refresh halaman.',
        ]);
    }
    
    $request->authenticate();
    $request->session()->regenerate();
    return redirect()->intended(route('dashboard', absolute: false));
}
```

### Custom Rule

File: `app/Rules/RecaptchaRule.php`

```php
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

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('recaptcha.secret_key'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        $result = $response->json();
        Log::info('reCAPTCHA v3 Response:', $result);

        if (!($result['success'] ?? false)) {
            $fail('Verifikasi reCAPTCHA gagal. Silakan coba lagi.');
            return;
        }

        $score = $result['score'] ?? 0;
        if ($score < $this->minScore) {
            $fail('Verifikasi keamanan gagal. Silakan coba lagi.');
            Log::warning('reCAPTCHA score too low', ['score' => $score, 'ip' => request()->ip()]);
        }
    }
}
```

**Score Threshold**: 0.5 (default)
- 1.0 = Pasti manusia
- 0.5 = Threshold standar (recommended)
- 0.0 = Pasti bot

### View

File: `resources/views/auth/login.blade.php`

Load script di head (conditional):
```blade
@push('scripts')
    @if(config('recaptcha.enabled', false))
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form[action="{{ route('login') }}"]');
                
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    grecaptcha.ready(function() {
                        grecaptcha.execute('{{ config('recaptcha.site_key') }}', {action: 'login'}).then(function(token) {
                            let input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'g-recaptcha-response';
                            input.value = token;
                            form.appendChild(input);
                            form.submit();
                        });
                    });
                });
            });
        </script>
    @endif
@endpush
```

**Tidak perlu widget/checkbox** - v3 bekerja otomatis di background!

Error handling:
```blade
@error('g-recaptcha-response')
    <li>{{ $message }}</li>
@enderror
```

## 4. Testing

### Development (reCAPTCHA disabled)

Set di `.env`:
```env
RECAPTCHA_ENABLED=false
```

Jalankan aplikasi:
```bash
php artisan config:clear
php artisan serve
```

Login akan bekerja **tanpa reCAPTCHA** - cocok untuk testing cepat.

### Production (reCAPTCHA enabled)

Set di `.env`:
```env
RECAPTCHA_ENABLED=true
RECAPTCHA_MIN_SCORE=0.5
```

**v3 bekerja otomatis tanpa interaksi user!**

Cek log untuk melihat score:
```bash
tail -f storage/logs/laravel.log
```

**Test Case**: Login normal - cek log untuk melihat score dan validation status

## 5. Use Cases

### Environment-Specific Configuration

**Local Development**:
```env
RECAPTCHA_ENABLED=false  # Tidak perlu reCAPTCHA
```

**Staging/Testing**:
```env
RECAPTCHA_ENABLED=true
RECAPTCHA_MIN_SCORE=0.3  # Lebih permisif untuk testing
```

**Production**:
```env
RECAPTCHA_ENABLED=true
RECAPTCHA_MIN_SCORE=0.5  # Balanced security
```

## 6. Troubleshooting

**reCAPTCHA tidak bekerja:**
- Cek `RECAPTCHA_ENABLED` di `.env` (harus `true`)
- Cek browser console untuk error JavaScript
- Pastikan `RECAPTCHA_SITE_KEY` sudah di `.env`
- Clear cache: `php artisan config:clear`

**Form langsung submit tanpa reCAPTCHA:**
- Kemungkinan `RECAPTCHA_ENABLED=false` di `.env`
- Cek log: `tail -f storage/logs/laravel.log` untuk "skipped" message

**Verifikasi selalu gagal:**
- Cek `RECAPTCHA_SECRET_KEY` di `.env`
- Pastikan domain sudah terdaftar di Google reCAPTCHA admin console
- Debug dengan cek log: `tail -f storage/logs/laravel.log`

**Score terlalu rendah:**
- Adjust `RECAPTCHA_MIN_SCORE` di `.env`
- 0.5 = balanced (recommended)
- 0.7 = strict
- 0.3 = permisive

**Invalid key type:**
- Pastikan menggunakan reCAPTCHA v3 keys, bukan v2
- Re-generate keys dengan memilih "reCAPTCHA v3" saat register

## Production Checklist

- Update domain di Google reCAPTCHA admin console
- Update keys di production `.env`
- **Set `RECAPTCHA_ENABLED=true`** di production
- Set `RECAPTCHA_MIN_SCORE` sesuai kebutuhan (0.5 recommended)
- Test di production domain
- Monitor score di log untuk fine-tuning
- Setup rate limiting: `->middleware('throttle:5,1')`
- **Set `RECAPTCHA_ENABLED=false`** di local development untuk testing cepat

## Response dari Google

Success (v3):
```json
{
  "success": true,
  "score": 0.9,
  "action": "login",
  "challenge_ts": "2026-02-05T10:30:15Z",
  "hostname": "localhost"
}
```

Error:
```json
{"success": false, "error-codes": ["missing-input-response", "invalid-input-response"]}
```

## Keuntungan v3 vs v2

**v3 (Score-based)**:
- Tidak mengganggu user experience (no checkbox)
- Bekerja di background
- Lebih akurat dengan machine learning
- Dapat adjust threshold sesuai kebutuhan

**v2 (Checkbox)**:
- User harus klik checkbox
- Kadang muncul challenge puzzle
- Lebih mengganggu UX

## Resources

- Google reCAPTCHA Admin: https://www.google.com/recaptcha/admin
- Documentation: https://developers.google.com/recaptcha/docs/v3
