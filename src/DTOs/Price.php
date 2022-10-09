<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Price extends DataTransferObject
{
    public float $amount;

    public ?float $wasAmount = null;

    public ?string $saleName = null;

    public function format(): string
    {
        return '$' . number_format($this->amount, 2);
    }
}
