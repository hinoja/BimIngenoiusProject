<?php

namespace App\Enums;

enum SizeEnums: string
{
    case Small = 'small';
    case Medium = 'medium';
    case Large = 'large';

    public function label(): string
    {
        return __('enums.size.' . $this->value);
    }
}