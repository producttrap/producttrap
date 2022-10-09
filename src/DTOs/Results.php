<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Results extends DataTransferObject
{
    public Category|Brand|string|null $search = null;

    public array $products;

    /** @var array<string, mixed> */
    public array $raw;
}
