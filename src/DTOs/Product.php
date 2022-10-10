<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use ProductTrap\Enums\Status;
use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Product extends DataTransferObject
{
    public string $identifier;

    public Status $status;

    public string $sku;

    public ?string $gtin = null;

    public ?string $name = null;

    public ?string $description = null;

    public ?string $url = null;

    public ?string $ingredients = null;

    public ?Price $price = null;

    public ?UnitAmount $unitAmount = null;

    public ?UnitPrice $unitPrice = null;

    public ?Brand $brand = null;

    public array $images = [];

    public array $categories = [];

    /** @var array<string, mixed> */
    public array $raw;
}
