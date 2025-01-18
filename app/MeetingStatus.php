<?php

namespace App;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum MeetingStatus: string implements HasLabel, HasColor
{
    case NOT_STARTED = 'not_started';
    case ONGOING = 'ongoing';
    case FINISHED = 'finished';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::NOT_STARTED => 'Not Started',
            self::ONGOING => 'Ongoing',
            self::FINISHED => 'Finished',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FINISHED => 'success',
            self::ONGOING => 'warning',
            self::NOT_STARTED => 'gray',
        };
    }
}
