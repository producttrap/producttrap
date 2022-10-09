<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Currency extends DataTransferObject
{
    public string $code;
}
