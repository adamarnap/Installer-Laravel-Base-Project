<?php

namespace App\Http\Requests;

use App\Enums\JenisIdentitasEnum;
use App\Enums\JenisKelaminEnum;
use App\Enums\JenisPendidikanEnum;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'jenis_identitas' => ['nullable', Rule::in(array_column(JenisIdentitasEnum::cases(), 'value'))],
            'nomor_identitas' => ['nullable', 'string', 'max:20'],
            'has_npwp' => ['nullable', 'boolean'],
            'jenis_kelamin' => ['nullable', Rule::in(array_column(JenisKelaminEnum::cases(), 'value'))],
            'ponsel' => ['nullable', 'regex:/^\d{1,13}$/'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'tempat_lahir' => ['nullable', 'string', 'max:50'],
            'tanggal_lahir' => ['nullable', 'date'],
            'pekerjaan' => ['nullable', 'string', 'max:50'],
            'instansi' => ['nullable', 'string', 'max:50'],
            'pendidikan' => ['nullable', Rule::in(array_column(JenisPendidikanEnum::cases(), 'value'))],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
