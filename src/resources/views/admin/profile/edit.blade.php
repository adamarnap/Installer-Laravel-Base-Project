@extends('layouts.admin.master')

@section('title', 'Profile Saya')

@section('breadcrumb')
    {{ Breadcrumbs::render('profile') }}
@endsection

@section('content')
{{-- START : Update Biodata --}}
<div class="card border bg-white rounded w-full">
    <div class="card-header py-4 px-5">
        <h4>Biodata</h4>
    </div>
    <form action="{{ route('profile.update') }}" method="POST" id="generalInformationForm" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body">
            <h5 class="mb-4"><i class="ti ti-user text-primary me-1"></i>Pengaturan data diri anda dalam aplikasi ini</h5>
            {{-- Start: Load Photo Profile --}}
            @php
                $profile = $user->userProfile;
                $profile_photo = $profile?->profile_photo
                    ? URL::asset('storage/' . $profile->profile_photo)
                    : URL::asset('assets/admin/images/users/default.jpg');
            @endphp
            {{-- End: Load Photo Profile --}}

            <div class="grid grid-cols-1 md:grid-cols-12 gap-x-5 gap-y-1 mb-6">
                {{-- Start: Foto Profile --}}
                <div class="md:col-span-12">
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <div class="flex items-center justify-center w-[120px] h-120 rounded-lg border border-2 border-dashed text-gray-400 p-2 relative">
                            <span class="text-center">
                                <img src="{{ $profile_photo }}" alt="user-image" class="ti ti-circle-plus mb-1 fs-16 block rounded-md">
                            </span>
                        </div>
                        <div class="ms-4">
                            <div class="flex items-center space-x-2">
                                <label class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white bg-primary text-white">
                                    Upload Foto Profil
                                    <input type="file" name="profile_photo" id="fileInput" class="hidden" accept="image/*">
                                </label>
                            </div>
                            <p class="text-gray-500 mt-2">Hanya menerima format file JPG, JPEG, PNG. Dalam batas ukuran file maksimum sebesar 2 MB.</p>
                        </div>
                    </div>
                </div>
                {{-- End: Foto Profile --}}

                {{-- Start: Nama Lengkap --}}
                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Nama<span class="text-primary ms-1">*</span></label>
                        <input name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                </div>
                {{-- End: Nama Lengkap --}}

                {{-- Start: Email --}}
                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Email<span class="text-primary ms-1">*</span></label>
                        <input name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required readonly>
                    </div>
                </div>
                {{-- End: Email --}}

                {{-- Start: Role --}}
                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Peran<span class="text-primary ms-1">*</span></label>
                        <input name="role" type="text" class="form-control" value="{{ ucwords(implode(', ', $user->roles->pluck('name')->toArray())) }}" disabled>
                    </div>
                </div>
                {{-- End: Role --}}
                
                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Jenis Identitas</label>
                        <select name="jenis_identitas" class="select">
                            <option value="">Pilih jenis identitas</option>
                            @foreach (\App\Enums\JenisIdentitasEnum::cases() as $jenisIdentitas)
                                <option value="{{ $jenisIdentitas->value }}" @selected(old('jenis_identitas', $profile?->jenis_identitas) === $jenisIdentitas->value)>
                                    {{ $jenisIdentitas->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Nomor Identitas</label>
                        <input name="nomor_identitas" type="text" class="form-control" value="{{ old('nomor_identitas', $profile?->nomor_identitas) }}" maxlength="20" placeholder="Masukkan nomor identitas">
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">NPWP</label>
                        <input type="hidden" name="has_npwp" value="0">
                        <div class="flex items-center gap-2 mt-3">
                            <input name="has_npwp" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary" {{ old('has_npwp', $profile?->has_npwp) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-600">Memiliki NPWP</span>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="select">
                            <option value="">Pilih jenis kelamin</option>
                            @foreach (\App\Enums\JenisKelaminEnum::cases() as $jenisKelamin)
                                <option value="{{ $jenisKelamin->value }}" @selected(old('jenis_kelamin', $profile?->jenis_kelamin) === $jenisKelamin->value)>
                                    {{ $jenisKelamin->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Ponsel</label>
                        <input name="ponsel" type="text" class="form-control" value="{{ old('ponsel', $profile?->ponsel) }}" maxlength="13" inputmode="numeric" pattern="[0-9]*" placeholder="Masukkan nomor ponsel">
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Tempat Lahir</label>
                        <input name="tempat_lahir" type="text" class="form-control" value="{{ old('tempat_lahir', $profile?->tempat_lahir) }}" maxlength="50" placeholder="Masukkan tempat lahir">
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="date" class="form-control" value="{{ old('tanggal_lahir', optional($profile?->tanggal_lahir)->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan</label>
                        <input name="pekerjaan" type="text" class="form-control" value="{{ old('pekerjaan', $profile?->pekerjaan) }}" maxlength="50" placeholder="Masukkan pekerjaan">
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Instansi</label>
                        <input name="instansi" type="text" class="form-control" value="{{ old('instansi', $profile?->instansi) }}" maxlength="50" placeholder="Masukkan instansi">
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="mb-3">
                        <label class="form-label">Pendidikan</label>
                        <select name="pendidikan" class="select">
                            <option value="">Pilih pendidikan</option>
                            @foreach (\App\Enums\JenisPendidikanEnum::cases() as $pendidikan)
                                <option value="{{ $pendidikan->value }}" @selected(old('pendidikan', $profile?->pendidikan) === $pendidikan->value)>
                                    {{ $pendidikan->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="md:col-span-12">
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="4" maxlength="500" placeholder="Masukkan alamat lengkap">{{ old('alamat', $profile?->alamat) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="flex items-center justify-end gap-x-2">
                <button type="submit" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white"><i class="ti ti-tag text-white me-1"></i> Simpan Biodata</button>
            </div>
        </div>
    </form>
</div>
{{-- END : Update Biodata --}}

{{-- START : Update Password --}}
<div class="card border bg-white rounded w-full">
    <div class="card-header py-4 px-5">
        <h4>Password</h4>
    </div>
    <form action="{{ route('password.update') }}" id="updatePasswordForm" method="POST">
    @csrf
    @method('put')
    <div class="card-body">
        <h5 class="mb-4"><i class="ti ti-lock text-danger me-1"></i>Pengaturan kata sandi akun anda pada aplikasi ini</h5>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-x-5 gap-y-1 mb-6">
            <div class="md:col-span-4">
                <div class="mb-3">
                    <label class="form-label">Password Saat Ini<span class="text-primary ms-1">*</span></label>
                    <input name="current_password" type="password" class="form-control" placeholder="Masukkan password saat ini ...">
                </div>
            </div>
            <div class="md:col-span-4">
                <div class="mb-3">
                    <label class="form-label">Password Baru<span class="text-primary ms-1">*</span></label>
                    <input name="password" type="password" class="form-control" placeholder="Masukkan password baru ..." required>
                </div>
            </div>
            <div class="md:col-span-4">
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru<span class="text-primary ms-1">*</span></label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Konfirmasi password baru ..." required>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="flex items-center justify-end gap-x-2">
            <button type="submit" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-hover hover:text-white"><i class="ti ti-lock text-white me-1"></i> Simpan Password Baru</button>
        </div>
    </div>
    </form>
</div>
{{-- END : Update Password --}}

{{-- START: Delete Account --}}
<div class="card border bg-white rounded w-full">
    <div class="card-header py-4 px-5">
        <h4>Hapus Akun</h4>
    </div>
    <form action="{{ route('profile.destroy') }}" id="deleteAccountForm" method="POST">
        <div class="card-body">
        <h5 class="mb-4"><i class="ti ti-trash text-danger me-1"></i>Pengaturan hapus akun anda dari aplikasi ini</h5>
            @csrf
            @method('delete')
            <div class="grid grid-cols-1 md:grid-cols-12 gap-x-5 gap-y-1 mb-6">
                <div class="md:col-span-12">
                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini<span class="text-primary ms-1">*</span></label>
                        <input name="current_password" type="password" class="form-control" placeholder="Masukkan password saat ini untuk mengonfirmasi penghapusan akun ..." required>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="flex items-center justify-end gap-x-2">
                <button type="submit" id="delete-account-btn" class="btn bg-danger border border-danger text-white text-center hover:bg-danger-hover hover:text-white"><i class="ti ti-trash text-white me-1"></i> Hapus Akun</button>
            </div>
        </div>
    </form>
</div>
{{-- END: Delete Account --}}
@endsection

@push('scripts')
    <script>
        function submitFormGeneralInformation() {
            let form = document.getElementById('generalInformationForm');

            // Cek validitas form sebelum menjalankan SweetAlert
            if (!form.checkValidity()) {
                form.reportValidity(); // Menampilkan error bawaan HTML
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda ingin memperbarui informasi profile anda?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika valid, kirim form
                }
            });
        }

        function submitFormUpdatePassword() {
            let form = document.getElementById('updatePasswordForm');

            // Cek validitas form sebelum menjalankan SweetAlert
            if (!form.checkValidity()) {
                form.reportValidity(); // Menampilkan error bawaan HTML
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda ingin memperbarui kata sandi?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, perbarui!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika valid, kirim form
                }
            });
        }

        // Confirmation before delete account
        document.getElementById('delete-account-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah submit form langsung

            let form = document.getElementById('deleteAccountForm');

            // Cek validitas form sebelum menjalankan SweetAlert
            if (!form.checkValidity()) {
                form.reportValidity(); // Menampilkan error bawaan HTML
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus akun saya!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jika valid, kirim form
                }
            });
        });
    </script>
@endpush

