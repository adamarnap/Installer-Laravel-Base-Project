<?php

namespace App\Enums\Settings;

use App\Enums\Concerns\EnumValues;

enum SchedulerStatusEnum: string
{
    use EnumValues;

    case SUCCESS = 'SUCCESS';
    case FAILED = 'FAILED';
    case PENDING = 'PENDING';
    case RUNNING = 'RUNNING';

    public function label(): string
    {
        return match ($this) {
            self::SUCCESS => 'Sukses',
            self::FAILED => 'Gagal',
            self::PENDING => 'Pending',
            self::RUNNING => 'Sedang Berjalan',
        };
    }
}
