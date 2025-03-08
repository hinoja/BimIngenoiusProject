<?php

namespace App\Enums;

enum StatusEnums: string
{
    case InProgress = 'in_progress';
    case Pending = 'pending';
    case Completed = 'completed';

    public function label(): string
    {
        return __('enums.status.' . $this->value);
    }
}