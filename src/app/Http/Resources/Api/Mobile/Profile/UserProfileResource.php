<?php

namespace App\Http\Resources\Api\Mobile\Profile;

use App\Enums\JenisKelaminEnum;
use App\Enums\JenisPendidikanEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "nomor_identitas" => $this->profile->nomor_identitas ?? null,
            "has_npwp" => $this->profile->has_npwp ?? null,
            "ponsel" => $this->profile->ponsel ?? null,
            "jenis_kelamin" =>  JenisKelaminEnum::tryFrom($this->profile->jenis_kelamin)->label() ?? null,
            "tempat_lahir" => $this->profile->tempat_lahir ?? null,
            "tanggal_lahir" => $this->profile->tanggal_lahir ?? null,
            "alamat" => $this->profile->alamat ?? null,
            "pekerjaan" => $this->profile->pekerjaan ?? null,
            "instansi" => $this->profile->instansi ?? null,
            "pendidikan" => JenisPendidikanEnum::tryFrom($this->profile->pendidikan)->label() ?? null,
            "avatar_url" => $this->profile->profile_photo   
                ? asset('storage/profile-photos/' . basename($this->profile->profile_photo  ))
                : null,
            "joined_at" => $this->created_at->toDateTimeString(),
        ];
    }
}
