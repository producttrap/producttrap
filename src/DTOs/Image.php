<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Image extends DataTransferObject
{
    public ?string $main;

    public ?string $large = null;

    public ?string $medium = null;

    public ?string $thumbnail = null;
}
