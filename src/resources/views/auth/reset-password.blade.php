@extends('layouts.admin.auth')

@section('title', 'Atur Ulang Kata Sandi')

@section('auth-form')
    <form action="{{ route('password.store') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label for="userEmail" class="form-label">
                Email
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--mail input-icon text-default-400!"></i>
                <input type="email" class="form-input bg-default-100" id="userEmail"
                    placeholder="Masukkan email Anda yang terdaftar" disabled />
            </div>
        </div>

        <div class="mb-5" data-password="bar">
            <label for="userPassword" class="form-label">
                Password Baru
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--lock-password input-icon"></i>
                <input name="password" type="password" id="userPassword" class="form-input"
                    placeholder="Masukkan password baru" />
            </div>
            <div class="password-bar my-3"></div>
            <p class="text-default-400 text-xs">Gunakan 8+ karakter dengan huruf, angka, dan simbol.</p>
        </div>

        <div class="mb-5">
            <label for="userNewPassword" class="form-label">
                Konfirmasi Password Baru
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--lock-password input-icon"></i>
                <input name="password_confirmation" type="password" class="form-input" id="userNewPassword"
                    placeholder="Konfirmasi password baru" required />
            </div>
        </div>

        <div>
            <button type="submit"
                class="btn bg-primary w-full py-3 font-semibold text-white hover:bg-primary-hover">Update
                Password</button>
        </div>
    </form>

    {{-- Start: Resend Email Verification --}}
    <p class="text-default-400 mt-7.5">
    Belum menerima email konfirmasi reset password? Cek folder spam atau 
    
        <form method="POST" action="{{ route('verification.send') }}" class="inline-block">
            @csrf
            <button type="submit" class="text-primary font-semibold underline underline-offset-3 hover:text-primary/80 transition-colors duration-200 inline-flex items-center gap-1 text-center">

                Kirim ulang email verifikasi
            </button>
        </form>
    </p>
    {{-- End: Resend Email Verification --}}

    <p class="text-default-400 mt-7.5 text-center">
        Kembali ke
        <a href="{{ route('login') }}"
            class="text-primary font-semibold underline underline-offset-4">Halaman Masuk</a>
    </p>
@endsection