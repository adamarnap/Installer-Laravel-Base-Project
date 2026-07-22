<?php

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProfileService
{
    public function updateProfile(User $user, array $data, ?UploadedFile $profilePhoto = null): User
    {
        try {
            DB::beginTransaction();

            $user->fill([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            $profileData = [
                'jenis_identitas' => $data['jenis_identitas'] ?? null,
                'nomor_identitas' => $data['nomor_identitas'] ?? null,
                'has_npwp' => (bool) ($data['has_npwp'] ?? false),
                'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
                'ponsel' => $data['ponsel'] ?? null,
                'alamat' => $data['alamat'] ?? null,
                'tempat_lahir' => $data['tempat_lahir'] ?? null,
                'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
                'pekerjaan' => $data['pekerjaan'] ?? null,
                'instansi' => $data['instansi'] ?? null,
                'pendidikan' => $data['pendidikan'] ?? null,
                'updated_by' => auth()->id(),
            ];

            if (! $user->userProfile) {
                $profileData['created_by'] = auth()->id();
            }

            if ($user->userProfile) {
                $user->userProfile->update($profileData);
            } else {
                $user->userProfile()->create($profileData);
            }

            if ($profilePhoto) {
                $user->updateProfilePhoto($profilePhoto);
            }

            DB::commit();

            return $user->load('userProfile');
        } catch (Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
}
