<?php

namespace App\Enums;

enum StatusEnums: string
{
    case InProgress = 'in_progress';
    case Pending = 'pending';
    case Completed = 'completed';
    case Idea = 'Idee';

    public function label(): string
    {
        return __('enums.status.' . $this->value);
    }
}
