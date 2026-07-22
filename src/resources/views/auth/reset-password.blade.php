@extends('layouts.admin.auth')

@section('title', 'Atur Ulang Kata Sandi')

@section('content')
    <div class="login-wrapper reset-pass-wrap bg-img">
        <div class="login-content authent-content">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <div class="login-userset">
                    <div class="login-logo logo-normal">
                        <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="img">
                    </div>
                    <a href="{{ route('dashboard') }}" class="login-logo logo-white">
                    </a>
                    <div class="login-userheading">
                        <h3>Atur Ulang Kata Sandi?</h3>
                        <h4 class="text-[16px]">Masukkan kata sandi baru Anda dan konfirmasikan sekali lagi di kolom di
                            bawah ini.</h4>
                    </div>

                    {{-- START : Alert --}}
                    <div class="">
                        @if (session('status'))
                            <div class="py-2.5 px-3.5 bg-success/10 rounded text-[13px] text-success mb-3">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="py-2.5 px-3.5 bg-danger/10 rounded text-[13px] text-danger mb-3" role="alert">
                                <b><i class="bi bi-x-octagon"></i> Error :</b>
                                <ul>
                                    @foreach ($errors->get('password') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                    @foreach ($errors->get('token') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                    @foreach ($errors->get('email') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{-- END : Alert --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-4">
                        <label class="form-label block mb-2">Email <span class="text-red-600"> *</span></label>
                        <div class="relative pass-group">
                            <input name="email" type="email" class="form-control w-full pass-input" required
                                placeholder="Masukkan email anda di sini">
                            <span
                                class="absolute right-3 -translate-y-2/4 top-2/4 cursor-pointer text-gray-900 ti toggle-password ti-eye-off"></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label block mb-2">Password Baru<span class="text-red-600"> *</span></label>
                        <div class="relative pass-group">
                            <input name="password" type="password" class="form-control w-full pass-inputs" required
                                placeholder="Masukkan kata sandi baru">
                            <span
                                class="absolute right-3 -translate-y-2/4 top-2/4 cursor-pointer text-gray-900 ti toggle-passwords ti-eye-off"></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label block mb-2">Konfirmasi Password Baru<span class="text-red-600">
                                *</span></label>
                        <div class="relative pass-group">
                            <input name="password_confirmation" type="password" class="form-control w-full pass-inputa"
                                required placeholder="Ketik ulang kata sandi baru untuk konfirmasi">
                            <span
                                class="absolute right-3 -translate-y-2/4 top-2/4 cursor-pointer text-gray-900 ti toggle-passworda ti-eye-off"></span>
                        </div>
                    </div>
                    <div class="form-login">
                        <button type="submit" class="btn btn-login">Ubah Password</button>
                    </div>

                    <div class="signinform text-center">
                        <h4> Belum menerima email konfirmasi reset password? Cek folder spam atau <a href="{{ route('verification.send') }}" class="hover-a underline"> Kirim ulang email verifikasi</a></h4>
                    </div>

                    

                    <div class="signinform text-center">
                        <h4>Kembali ke laman <a href="{{ route('login') }}" class="hover-a underline"> Masuk</a></h4>
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
