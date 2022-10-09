<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use ProductTrap\Enums\Unit;
use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class UnitPrice extends DataTransferObject
{
    public UnitAmount $unitAmount;

    public Price $price;

    public function label(): string
    {
        return $this->price->format().' / '.$this->unitAmount->format();
    }

    public static function determine(?Price $price = null, ?UnitAmount $unitAmount = null, ?string $unitPrice = null): ?UnitPrice
    {
        if ($price === null && $unitAmount === null && $unitPrice === null) {
            return null;
        }

        if ($unitPrice !== null) {
            preg_match('/\$([\d\.,]+)\W*([\d\.,]+)?(g|kg|mg|ml|l|ea|pc|piece)/i', $unitPrice, $matches);

            if (empty($matches[1])) {
                return null;
            }

            $price = new Price(
                amount: (float) str_replace(',', '', $matches[1]),
            );

            $unitAmount = new UnitAmount(
                unit: Unit::parse($matches[3]),
                amount: (float) str_replace(',', '', ($matches[2] === '') ? '1' : $matches[2]),
            );
        }

        if ($price === null || $unitAmount === null) {
            return null;
        }

        return Unit::reduce(
            price: $price,
            unitAmount: $unitAmount,
        );
    }
}
