<?php

namespace App\Enums;

enum JenisPendidikanEnum: string
{
    case TK = 'TK';
    case SD = 'SD';
    case SMP = 'SMP';
    case SMA = 'SMA';
    case D3 = 'D3';
    case S1 = 'S1';
    case S2 = 'S2';
    case S3 = 'S3';

    public function label(): string
    {
        return match($this) {
            JenisPendidikanEnum::TK => 'Taman Kanak-kanak',
            JenisPendidikanEnum::SD => 'Sekolah Dasar',
            JenisPendidikanEnum::SMP => 'SLTP Sederajat',
            JenisPendidikanEnum::SMA => 'SLTA Sederajat',
            JenisPendidikanEnum::D3 => 'Diploma 3',
            JenisPendidikanEnum::S1 => 'Strata 1',
            JenisPendidikanEnum::S2 => 'Strata 2',
            JenisPendidikanEnum::S3 => 'Strata 3',
        };
    }
}
