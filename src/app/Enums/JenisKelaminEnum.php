<?php

namespace App\Enums;

enum JenisKelaminEnum: string
{
    case LAKILAKI = 'L';
    case PEREMPUAN = 'P';

    public function label(): string
    {
        return match ($this) {
            self::LAKILAKI => 'Laki-laki',
            self::PEREMPUAN => 'Perempuan',
        };
    }
}
