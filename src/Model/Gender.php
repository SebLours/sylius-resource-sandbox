<?php

declare(strict_types=1);

namespace App\Model;

enum Gender: string
{
    case FEMALE = 'female';
    case MALE = 'male';

    public function asString(): string
    {
        return match ($this) {
            self::FEMALE => 'female',
            self::MALE => 'male',
        };
    }
}
