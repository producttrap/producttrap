<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class Results extends DataTransferObject
{
    public Query $query;

    /** @var array<int, Product> */
    public array $products = [];

    /** @var array<string, mixed> */
    public array $raw;

    public function merge(Results $results): self
    {
        $productsUnique = [];

        foreach ([$this->products, $results->products] as $source) {
            foreach ($source as $product) {
                /** @var Product $product */
                $productsUnique[$product->identifier] = $product;
            }
        }

        $this->products = array_values($productsUnique);

        return $this;
    }
}
