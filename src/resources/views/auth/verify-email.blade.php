@extends('layouts.admin.auth')

@section('title', 'Verifikasi Email')

@section('content')
<div class="login-wrapper email-veri-wrap bg-img">
    <div class="login-content authent-content">
        <div class="login-userset text-center">
            <div class="login-logo logo-normal">
                <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="img" class="mx-auto">
            </div>
            <a href="{{ route('dashboard') }}" class="login-logo logo-white">
            </a>
            <div class="flex flex-col items-center">
                <div class="login-userheading">
                    <h3>Email Verifikasi Terkirim</h3>
                    <h4>Silahkan cek email yang Anda berikan saat pendaftaran, link verifikasi ada di dalamnya!</h4>
                </div>
                <div class="w-full flex justify-center">
                    @if (session('status') == 'verification-link-sent')
                        <div class="py-2.5 px-3.5 bg-success/10 rounded text-[13px] text-success mb-3 max-w-md w-full">
                            Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
                        </div>
                    @endif
                </div>
                <div class="text-center otp-input w-full">
                    <div class="flex flex-col items-center gap-3">
                        <p class="text-gray-9">Belum mendapatkan email verifikasi ?</p>
                        <div class="flex justify-center">
                            <form action="{{ route('verification.send') }}" method="POST" class="digit-group">
                                @csrf
                                <button type="submit" class="btn text-primary">Kirim ulang email verifikasi</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-3 w-full flex justify-center">
                    <form method="POST" action="{{ route('logout') }}" class="w-full max-w-md">
                        @csrf
                        <button type="submit" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white w-full">Kembali ke Beranda</button>
                    </form>
                </div>
            </div>
            <div class="my-6 w-full flex justify-center items-center text-center copyright-text">
                <span class="text-purple-500">{{ $prefs_composer['title'] }}</span>
                &nbsp; {!! $prefs_composer['copyright'] !!} &nbsp; {!! $prefs_composer['credits'] !!}
            </div>
        </div>
    </div>
</div>
@endsection
