<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Category extends DataTransferObject
{
    public string $identifier;

    public string $name;

    public ?string $url = null;
}
