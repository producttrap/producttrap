<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;
use Stringable;

#[Strict]
class Query extends DataTransferObject implements Stringable
{
    public const TYPE_KEYWORD = 'keyword';
    public const TYPE_CATEGORY = 'category';
    public const TYPE_BRAND = 'brand';

    public ?string $keywords = null;

    public ?Category $category = null;

    public ?Brand $brand = null;

    public static function fromKeywords(string $keywords): self
    {
        return new self(
            keywords: $keywords,
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

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * If a driver does not support Brand or Category pages, calling toString
     * will cast this object to a string and will return the brand, category
     * and/or search query string which can then be used in a standard search
     */
    public function toString(): string
    {
        return trim(implode(' ', array_filter([
            $this->keywords,
            $this->category?->name,
            $this->brand?->name,
        ])));
    }

    public function type(): string
    {
        if ($this->category !== null) {
            return static::TYPE_CATEGORY;
        }

        if ($this->brand !== null) {
            return static::TYPE_BRAND;

        }
        return static::TYPE_KEYWORD;
    }

    public function cacheKey(): string
    {
        return 'producttrap.query.' . hash('sha256', json_encode($this->toArray()));
    }
}
