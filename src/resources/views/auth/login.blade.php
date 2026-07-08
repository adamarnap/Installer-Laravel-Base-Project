@extends('layouts.admin.auth')

@section('title', 'Masuk')

@push('scripts')
    @if (config('recaptcha.enabled', false))
        {{-- Google reCAPTCHA v3 Script --}}
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form[action="{{ route('login') }}"]');

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    grecaptcha.ready(function() {
                        grecaptcha.execute('{{ config('recaptcha.site_key') }}', {
                            action: 'login'
                        }).then(function(token) {
                            // Tambahkan token ke form
                            let input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'g-recaptcha-response';
                            input.value = token;
                            form.appendChild(input);

                            // Submit form
                            form.submit();
                        });
                    });
                });
            });
        </script>
    @endif
@endpush

@section('auth-form')
{{-- Start : Login Form --}}
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label for="userEmail" class="form-label">
                Email
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--mail input-icon"></i>
                <input name="email" type="email" class="form-input" id="userEmail"
                    placeholder="jhon&#64;example.com" required />
            </div>
        </div>

        <div class="mb-5">
            <label for="userPassword" class="form-label">
                Password
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--lock-password input-icon"></i>
                <input name="password" type="password" class="form-input" id="userPassword"
                    placeholder="••••••••" required />
            </div>
        </div>

        <div class="mb-5 flex items-center justify-between">
            <a href="{{ route('password.request') }}"
                class="text-default-400 underline underline-offset-4">Lupa Password?</a>
        </div>

        <div>
            <button type="submit"
                class="btn bg-primary w-full py-3 font-semibold text-white hover:bg-primary-hover">Masuk</button>
        </div>
    </form>

    <p class="text-default-400 mt-7.5 text-center">
        Belum memiliki akun ?
        <a href="{{ route('register') }}"
            class="text-primary font-semibold underline underline-offset-4">Buat akun disini.</a>
    </p>
{{-- End : Login Form --}}
@endsection
