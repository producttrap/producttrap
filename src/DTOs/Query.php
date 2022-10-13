<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Query extends DataTransferObject
{
    public ?string $search = null;

    public ?Category $category = null;

    public ?Brand $brand = null;

    public static function fromKeywords(string $keywords): self
    {
        return new self(
            search: $keywords,
        );
    }

    public static function fromCategory(Category $category): self
    {
        return new self(
            category: $category,
        );
    }

    public static function fromBrand(Brand $brand): self
    {
        return new self(
            brand: $brand,
        );
    }

    /**
     * If a driver does not support Brand or Category pages, calling toString
     * to a string will return the brand, category or search as a string which
     * can then be used in a standard search page.
     */
    public function toString(): string
    {
        return trim(implode(' ', array_filter([
            $this->search,
            $this->category?->name,
            $this->brand?->name,
        ])));
    }
}
