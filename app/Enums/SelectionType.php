<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SelectionType: string implements HasLabel
{
    case SINGLE = 'single';
    case MULTIPLE = 'multiple';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SINGLE => 'Single',
            self::MULTIPLE => 'Multiple',
        };
    }
}
