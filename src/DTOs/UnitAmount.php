<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use ProductTrap\Enums\Unit;
use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class UnitAmount extends DataTransferObject
{
    public Unit $unit;

    public float $amount;

    public function format(): string
    {
        return $this->amount.$this->unit->value;
    }

    public static function parse(string $string): UnitAmount
    {
        preg_match('/([\d.]+)\W*(l|ml|g|kg|mg|ea|each|pc|piece)/i', $string, $matches);

        if (! isset($matches[1])) {
            return new self(
                unit: Unit::EACH,
                amount: 1,
            );
        }

        $amount = (float) $matches[1];
        $unit = $matches[2];

        // parse 85g => grams + 85
        return new self(
            unit: Unit::parse($unit),
            amount: $amount,
        );
    }
}
