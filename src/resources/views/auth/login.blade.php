@extends('layouts.admin.auth')

@section('title', 'Masuk')

@push('scripts')
    @if(config('recaptcha.enabled', false))
        {{-- Google reCAPTCHA v3 Script --}}
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form[action="{{ route('login') }}"]');
                
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    grecaptcha.ready(function() {
                        grecaptcha.execute('{{ config('recaptcha.site_key') }}', {action: 'login'}).then(function(token) {
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

@section('content')
<div class="login-wrapper bg-img">
    <div class="login-content authent-content">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="login-userset">
                <div class="login-logo logo-normal">
                    <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="img">
                </div>
                <a href="{{ route('dashboard') }}" class="login-logo logo-white">
                </a>
                <div class="login-userheading">
                    <h3>Masuk</h3>
                    <h4 class="text-[16px]">Silahkan masuk dengan akun yang telah anda buat.</h4>
                </div>
                <div class="">
                    @if (session('status'))
                    <div
                        class="py-2.5 px-3.5 bg-success/10 rounded text-[13px] text-success mb-3">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="py-2.5 px-3.5 bg-danger/10 rounded text-[13px] text-danger mb-3" role="alert">
                            <b><i class="bi bi-x-octagon"></i> Error :</b>
                            <ul>
                                @error('email')
                                    <li>{{ $message }}</li>
                                @enderror
                                @error('password')
                                    <li>{{ $message }}</li>
                                @enderror
                                @error('g-recaptcha-response')
                                    <li>{{ $message }}</li>
                                @enderror
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="mb-4">
                    <label class="form-label block mb-2">Email <span class="text-red-600"> *</span></label>
                    <div class="input-group w-auto input-group-flat">
                        <input name="email" type="email" class="form-control" id="email" placeholder="Masukkan email anda" required>
                        <span class="input-group-text">
                            <i class="ti ti-mail"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label block mb-2">Password<span class="text-red-600">
                            *</span></label>
                    <div class="relative pass-group">
                        <input name="password" type="password" class="form-control w-full pass-input" id="password" placeholder="Masukkan password anda" required>
                        <span
                            class="absolute right-3 -translate-y-2/4 top-2/4 cursor-pointer text-gray-900 ti toggle-password ti-eye-off"></span>
                    </div>
                </div>
                <div class="form-login authentication-check">
                    <div class="flex flex-wrap">
                        <div class="w-full flex items-center justify-between">
                            <div class="text-right">
                                <a class="text-orange text-[16px] font-medium"
                                    href="{{ route('password.request') }}">Lupa kata sandi?</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-login">
                    <button type="submit" class="btn btn-login">Masuk</button>
                </div>
                <div class="signinform">
                    <h4>Belum memiliki akun?<a href="{{ route('register') }}" class="hover-a"> Buat akun anda sekarang</a>
                    </h4>
                </div>
                <div class="my-6 flex justify-center items-center copyright-text">
                    <span class="text-purple-500">{{ $prefs_composer['title'] }}</span> 
                    &nbsp; {!! $prefs_composer['copyright'] !!} &nbsp; {!! $prefs_composer['credits'] !!}
                </div>
            </div>
        </form>
    </div>
</div>
@endsection