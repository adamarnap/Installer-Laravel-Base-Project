@extends('layouts.admin.master')

@section('title', 'Profile Saya')

@section('breadcrumb')
    {{ Breadcrumbs::render('profile') }}
@endsection

@section('content')
    @php
        $profile_photo = Auth::user()?->userProfile?->profile_photo
            ? URL::asset('storage/' . Auth::user()->userProfile->profile_photo)
            : URL::asset('assets/admin/images/users/default.jpg');
        $roles = ucwords(implode(', ', $user->roles->pluck('name')->toArray()));
        $profile_bg = URL::asset('assets/admin/images/profile-bg.jpg');
    @endphp

    <div class="mb-5">
        <div class="relative h-62.5 overflow-hidden rounded bg-cover bg-center" style="min-height: 300px; background-image: url('{{ $profile_bg }}');">
            <div class="absolute inset-0 flex flex-col items-center justify-center gap-4 bg-linear-to-t from-[#313A46] via-[#313a46cc] to-[#313a4680] p-7.5 text-center">

                <div>
                    <h3 class="text-2xl text-white italic">
                        {{ $user->name }}
                    </h3>
                    <p class="mt-2 text-md text-white">
                        {{ $roles }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card -mt-12">
        <div class="card-body space-y-8">
            <form action="{{ route('profile.update') }}" method="POST" id="generalInformationForm" enctype="multipart/form-data" class="mb-5">
                @csrf
                @method('patch')

                <h5 class="bg-light/15 border-default-300 mb-5 flex items-center justify-center gap-1.5 rounded border border-dashed p-1.25 text-sm uppercase">
                    <i class="iconify tabler--user-circle text-base"></i>
                    Personal Info
                </h5>

                <div class="grid grid-cols-1 gap-x-base gap-y-5 mb-base lg:grid-cols-2">
                    <div class="lg:col-span-2">
                        <label for="profile_photo" class="form-label">Profile Photo</label>
                        <div class="flex flex-col gap-4 rounded border border-dashed border-default-300 p-5 md:flex-row md:items-center">
                            <img src="{{ $profile_photo }}" alt="Profile Photo" class="h-20 w-20 rounded-full object-cover">
                            <div class="flex-1">
                                <input
                                    type="file"
                                    name="profile_photo"
                                    id="profile_photo"
                                    class="form-input"
                                    accept="image/*"
                                />
                                <p class="mt-2 text-xs italic text-default-400">
                                    Upload a new image to replace the current profile photo.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-input"
                            placeholder="Enter name"
                            value="{{ $user->name }}"
                            required
                        />
                    </div>

                    <div>
                        <label for="email" class="form-label">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-input"
                            placeholder="Enter email"
                            value="{{ $user->email }}"
                            readonly
                        />
                        <span class="text-default-400 text-xs italic">
                            Email cannot be changed from this page.
                        </span>
                    </div>
                </div>

                <div class="mt-7.5 text-end">
                    <button type="submit" class="btn bg-success text-white hover:bg-success-hover">
                        Update Profile
                    </button>
                </div>
            </form>

            <form action="{{ route('password.update') }}" id="updatePasswordForm" method="POST" class="mb-5">
                @csrf
                @method('put')

                <h5 class="bg-light/15 border-default-300 mb-5 flex items-center justify-center gap-1.5 rounded border border-dashed p-1.25 text-sm uppercase">
                    <i class="iconify tabler--lock text-base"></i>
                    Update Password
                </h5>

                <div class="grid grid-cols-1 gap-x-base gap-y-5 mb-base lg:grid-cols-3">
                    <div>
                        <label for="current_password" class="form-label">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            class="form-input"
                            placeholder="Type current password ..."
                            required
                        />
                    </div>

                    <div>
                        <label for="password" class="form-label">New Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-input"
                            placeholder="Type new password ..."
                            required
                        />
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-input"
                            placeholder="Confirm new password ..."
                            required
                        />
                    </div>
                </div>

                <div class="mt-7.5 text-end">
                    <button type="submit" class="btn bg-danger text-white hover:bg-danger-hover">
                        Update Password
                    </button>
                </div>
            </form>

            <form action="{{ route('profile.destroy') }}" id="deleteAccountForm" method="POST">
                @csrf
                @method('delete')

                <h5 class="bg-light/15 border-default-300 mb-5 flex items-center justify-center gap-1.5 rounded border border-dashed p-1.25 text-sm uppercase">
                    <i class="iconify tabler--trash text-base"></i>
                    Delete Account
                </h5>

                <div class="grid grid-cols-1 gap-x-base gap-y-5 mb-base">
                    <div>
                        <label for="delete_password" class="form-label">Current Password for Confirmation</label>
                        <input
                            type="password"
                            name="password"
                            id="delete_password"
                            class="form-input"
                            placeholder="Type current password for confirmation if you need delete account ..."
                            required
                        />
                    </div>
                </div>

                <div class="mt-7.5 text-end">
                    <button type="submit" id="delete-account-btn" class="btn bg-danger text-white hover:bg-danger-hover">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
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
