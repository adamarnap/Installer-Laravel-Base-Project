@extends('layouts.admin.auth')

@section('title', 'Lupa Kata Sandi')

@section('auth-form')
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="mb-5">
            <label for="userEmail" class="form-label">
                Email
                <span class="text-danger">*</span>
            </label>
            <div class="input-icon-group">
                <i class="iconify tabler--mail input-icon"></i>
                <input name="email" type="email" class="form-input" id="userEmail"
                    placeholder="Masukkan email Anda yang terdaftar" required />
            </div>
        </div>

        <div>
            <button type="submit"
                class="btn bg-primary w-full py-3 font-semibold text-white hover:bg-primary-hover">Kirim email untuk reset kata sandi</button>
        </div>
    </form>
    <p class="text-default-400 mt-7.5 text-center">
        Kembali ke
        <a href="{{ route('login') }}"
            class="text-primary font-semibold underline underline-offset-4"> halaman masuk</a>
    </p>
@endsection