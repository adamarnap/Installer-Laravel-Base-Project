@extends('layouts.admin.auth')

@section('title', 'Daftar')

@section('auth-form')
    <form action="{{ route('register') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-5">
            <label for="userName" class="form-label">
                Name
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--user input-icon"></i>
                <input name="name" type="text" class="form-input" id="userName" value="{{ old('name') }}"
                    placeholder="Masukkan nama Anda" required />
            </div>
        </div>

        <div class="mb-5">
            <label for="userEmail" class="form-label">
                Email
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--mail input-icon"></i>
                <input name="email" type="email" class="form-input" id="userEmail" value="{{ old('email') }}"
                    placeholder="Masukkan email Anda" required />
            </div>
        </div>

        <div class="mb-5" data-password="bar">
            <label for="userPassword" class="form-label">
                Password
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--lock-password input-icon"></i>
                <input name='password' type="password" id="userPassword" class="form-input"
                    placeholder="Masukkan kata sandi Anda" />
            </div>
            <div class="password-bar my-3"></div>
            <p class="text-default-400 text-xs">Gunakan 8+ karakter dengan huruf, angka, dan simbol.</p>
        </div>

        <div class="mb-5" data-password="bar">
            <label for="password_confirmation" class="form-label">
                Konfirmasi Password
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--lock-password input-icon"></i>
                <input name='password_confirmation' type="password" id="password_confirmation" class="form-input"
                    placeholder="Konfirmasi ulang kata sandi Anda" />
            </div>
        </div>

        <div class="mb-5">
            <div class="flex items-center gap-2">
                <input class="form-checkbox form-checkbox-light size-4.5" type="checkbox"
                    id="termAndPolicy" checked />
                <label class="form-check-label" for="termAndPolicy">Saya setuju dengan syarat dan ketentuan</label>
            </div>
        </div>

        <div>
            <button type="submit"
                class="btn bg-primary w-full py-3 font-semibold text-white hover:bg-primary-hover">Buat Akun</button>
        </div>
    </form>

    <p class="text-default-400 mt-7.5 text-center">
        Sudah memiliki akun ?
        <a href="{{ route('login') }}"
            class="text-primary font-semibold underline underline-offset-4">Login sekarang juga</a>
    </p>
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
