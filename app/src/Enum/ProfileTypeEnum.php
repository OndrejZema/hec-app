<?php

namespace App\Enum;

enum ProfileTypeEnum: string
{
    case MANUAL = 'manual';
    case AI = 'ai';

    public static function getChoices(): array
    {
        return [
            self::MANUAL->value => self::MANUAL,
            self::AI->value => self::AI,
        ];
    }
}
