@extends('layouts.admin.auth')

@section('title', 'Daftar')

@section('content')
    <div class="login-wrapper register-wrap bg-img">
        <div class="login-content authent-content">
            <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="login-userset">
                    <div class="login-logo logo-normal">
                        <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="img">
                    </div>
                    <a href="{{ route('dashboard') }}" class="login-logo logo-white">
                    </a>
                    <div class="login-userheading">
                        <h3>Daftarka Akun Anda di {{ $prefs_composer['title'] }}</h3>
                        <h4 class="text-[16px]">Buat akun baru anda untuk mengakses {{ $prefs_composer['title'] }}</h4>
                    </div>
                    {{-- START : Alert --}}
                    <div class="">
                        @if (session('status'))
                            <div
                                class="py-2.5 px-3.5 bg-success/10 rounded text-[13px] text-success mb-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="py-2.5 px-3.5 bg-danger/10 rounded text-[13px] text-danger mb-3"
                                role="alert">
                                <b><i class="bi bi-x-octagon"></i> Error :</b>
                                <ul>
                                    @error('name')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('email')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('password')
                                        <li>{{ $message }}</li>
                                    @enderror
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{-- END : Alert --}}
                    <div class="mb-4"> <label class="form-label block mb-2">Nama <span class="text-red-600">
                                *</span></label>
                        <div class="input-group w-auto input-group-flat">
                            <input name="name" type="text" class="form-control" required
                                placeholder="Masukkan nama lengkap anda">
                            <span class="input-group-text">
                                <i class="ti ti-user"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-4"> <label class="form-label block mb-2">Email <span class="text-red-600">
                                *</span></label>
                        <div class="input-group w-auto input-group-flat">
                            <input name="email" type="email" class="form-control" required
                                placeholder="Masukkan email anda">
                            <span class="input-group-text">
                                <i class="ti ti-mail"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label block mb-2">Password<span class="text-red-600"> *</span></label>
                        <div class="relative pass-group">
                            <input name="password" type="password" class="form-control w-full pass-input" required
                                placeholder="Masukkan password anda">
                            <span
                                class="absolute right-3 -translate-y-2/4 top-2/4 cursor-pointer text-gray-900 ti toggle-password ti-eye-off"></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label block mb-2">Konfirmasi Password<span class="text-red-600"> *</span></label>
                        <div class="relative pass-group">
                            <input name="password_confirmation" type="password" class="form-control w-full pass-input"
                                required placeholder="Masukkan konfirmasi password anda">
                            <span
                                class="absolute right-3 -translate-y-2/4 top-2/4 cursor-pointer text-gray-900 ti toggle-password ti-eye-off"></span>
                        </div>
                    </div>
                    <div class="form-login authentication-check">
                        <div class="flex flex-wrap">
                            <div class="w-full flex items-center justify-between">
                                <div class="form-check">
                                    <input class="text-primary rounded border-borderColor" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label for="flexCheckDefault"><span class="checkmarks"></span>Saya setuju dengan <a
                                            href="#" class="text-primary">Syarat & Ketentuan</a></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-login">
                        <button type="submit" class="btn btn-login">Daftar</button>
                    </div>
                    <div class="signinform">
                        <h4>Sudah memiliki akun? <a href="{{ route('login') }}" class="hover-a"> Masuk di sini</a></h4>
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

@push('scripts')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
            Array.from(forms).forEach((form) => {
                form.addEventListener(
                    'submit',
                    (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    },
                    false,
                );
            });
        })();
    </script>
@endpush
