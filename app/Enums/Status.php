<?php

namespace App\Enums;

enum Status: string
{
    case CREATED = 'created';
    case ASSIGNED = 'assigned';
    case COMPLETED = 'completed';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function isValid(string $status): bool
    {
        return in_array($status, self::all(), true);
    }

    public function getName(): string
    {
        return match ($this) {
            self::CREATED => 'Создан',
            self::ASSIGNED => 'Назначен исполнитель',
            self::COMPLETED => 'Завершен',
        };
    }
}
