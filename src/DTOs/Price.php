<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use ProductTrap\Enums\Currency;
use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Price extends DataTransferObject
{
    public float $amount;

    public ?float $wasAmount = null;

    public ?string $saleName = null;

    public ?Currency $currency = null;

    public function format(): string
    {
        $currency = ($this->currency) ? $this->currency->symbol() : '$';

        return $currency.number_format($this->amount, 2);
    }
}
