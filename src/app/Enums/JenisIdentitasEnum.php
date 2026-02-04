<?php

namespace App\Enums;

enum JenisIdentitasEnum: string
{
    case KTP = 'ktp';
    case SIM = 'sim';
    case PASSPORT = 'passport';
    case DLL = 'dll';

    public function label(): string
    {
        return match ($this) {
            self::KTP => 'KTP',
            self::SIM => 'SIM',
            self::PASSPORT => 'Passport',
            self::DLL => 'Lainnya',
        };
    }
}
