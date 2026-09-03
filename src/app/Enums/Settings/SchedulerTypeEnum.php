<?php

namespace App\Enums\Settings;

use App\Enums\Concerns\EnumValues;

enum SchedulerTypeEnum: string
{
    use EnumValues;

    case ARTISAN = 'artisan';
    case JOB = 'job';
    case CLOSURE = 'closure';

    public function label(): string
    {
        return match ($this) {
            self::ARTISAN => 'Artisan Command',
            self::JOB => 'Queue Job',
            self::CLOSURE => 'Closure / Callback',
        };
    }
}
