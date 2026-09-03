<?php

namespace App\Enums\Concerns;

trait EnumValues
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLabel(?string $value, ?string $default = null): ?string
    {
        return self::tryFrom($value)?->label() ?? $default;
    }

    public static function options(): array
    {
        return array_map(
            fn (self $case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases()
        );
    }

    public function label(): string
    {
        return ucwords(str_replace('_', ' ', $this->value));
    }
}
