<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $table = 'users_profile';
    protected $fillable = [
        'jenis_identitas',
        'nomor_identitas',
        'has_npwp',
        'jenis_kelamin',
        'ponsel',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'instansi',
        'pendidikan',
        'profile_photo',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'has_npwp' => 'boolean',
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
