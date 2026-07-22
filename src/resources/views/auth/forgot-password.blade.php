@extends('layouts.admin.auth')

@section('title', 'Lupa Kata Sandi')

@section('content')
    <div class="login-wrapper forgot-pass-wrap bg-img">
        <div class="login-content authent-content">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="login-userset">
                    <div class="login-logo logo-normal">
                        <img src="{{ URL::asset($prefs_composer['logo']) }}" alt="img">
                    </div>
                    <a href="{{ route('dashboard') }}" class="login-logo logo-white">
                    </a>
                    <div class="login-userheading">
                        <h3>Lupa Password</h3>
                        <h4 class="text-[16px]">Lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda
                            dan kami akan mengirimkan
                            email berisi tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.
                        </h4>
                    </div>
                    {{-- START: Alert Message --}}
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
                                    @foreach ($errors->get('email') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    {{-- END: Alert Message --}}
                    <div class="mb-4"> <label class="form-label block mb-2">Email <span class="text-red-600">
                                *</span></label>
                        <div class="input-group w-auto input-group-flat">
                            <input type="email" name="email" class="form-control" required
                                placeholder="Masukkan email anda di sini">
                            <span class="input-group-text">
                                <i class="ti ti-mail"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-login">
                        <button type="submit" class="btn btn-login">Kirim Email Reset Kata Sandi</button>
                    </div>
                    <div class="signinform text-center">
                        <h4>Kembali ke laman<a href="{{ route('login') }}" class="hover-a"> Masuk</a></h4>
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
