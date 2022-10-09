<?php

declare(strict_types=1);

namespace ProductTrap\Enums;

enum Status: string
{
    case Available = 'available';
    case Unavailable = 'unavailable';
    case Not_Found = 'not_found';
    case Unknown = 'unknown';
    case Cancelled = 'cancelled';

    public function description(): string
    {
        return match ($this) {
            self::Available => 'Available',
            self::Unavailable => 'Unavailable',
            self::Not_Found => 'Not Found',
            self::Unknown => 'Unknown',
            self::Cancelled => 'Cancelled',
        };
    }
}
