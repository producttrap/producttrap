<?php

namespace ProductTrap\Enums;

use ProductTrap\DTOs\Price;
use ProductTrap\DTOs\UnitAmount;
use ProductTrap\DTOs\UnitPrice;

enum Unit: string
{
    case MILLIGRAM = 'mg';
    case GRAM = 'g';
    case KILOGRAM = 'kg';
    case LITER = 'l';
    case MILLILITER = 'ml';
    case EACH = 'ea';

    public static function parse(string $text): Unit
    {
        $parts = preg_split('/(per|\/)/', $text);
        $text = ($parts === false) ? $text : $parts[0];
        $text = str_replace(' ', '', $text);
        $text = preg_replace('/[\d\.]+/', '', $text);
        $text = strtolower((string) $text);
        $text = rtrim($text, 's');

        $map = [
            'mg' => self::MILLIGRAM,
            'milligram' => self::MILLIGRAM,
            'g' => self::GRAM,
            'gram' => self::GRAM,
            'kg' => self::KILOGRAM,
            'kilogram' => self::KILOGRAM,
            'l' => self::LITER,
            'litre' => self::LITER,
            'ml' => self::MILLILITER,
            'mililitre' => self::MILLILITER,
            'pc' => self::EACH,
            'piece' => self::EACH,
            'ea' => self::EACH,
            'each' => self::EACH,
        ];

        return $map[$text] ?? self::EACH;
    }

    public static function reduce(Price|float $price, UnitAmount $unitAmount): UnitPrice
    {
        $price = ($price instanceof Price) ? $price->amount : $price;

        $factor = match ($unitAmount->unit) {
            self::MILLIGRAM => 1000000,
            self::GRAM => 1000,
            self::MILLILITER => 1000,
            default => 1,
        };

        $unitTo = match ($unitAmount->unit) {
            self::MILLIGRAM => self::KILOGRAM,
            self::GRAM => self::KILOGRAM,
            self::MILLILITER => self::LITER,
            default => $unitAmount->unit,
        };

        $amountFactor = $factor / $unitAmount->amount;
        $pricePerUnitTo = round($price * $amountFactor, 2);

        return new UnitPrice(
            unitAmount: new UnitAmount(
                unit: $unitTo,
                amount: 1,
            ),
            price: new Price(
                amount: $pricePerUnitTo,
            ),
        );
    }
}
