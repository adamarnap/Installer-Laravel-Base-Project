<?php

namespace App\Enums\Settings;

use App\Enums\Concerns\EnumValues;

enum SchedulerNotificationEnum: string
{
    use EnumValues;

    case NONE = 'none';
    case EMAIL = 'email';
    case SLACK = 'slack';

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'Tanpa Notifikasi',
            self::EMAIL => 'Email',
            self::SLACK => 'Slack Webhook',
        };
    }
}
