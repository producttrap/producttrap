<?php

namespace ProductTrap\Drivers;

use ProductTrap\Contracts\Driver;
use ProductTrap\DTOs\Brand;
use ProductTrap\DTOs\Product;
use ProductTrap\DTOs\Results;
use ProductTrap\Enums\Status;
use ProductTrap\Exceptions\ApiAuthenticationFailedException;
use ProductTrap\Exceptions\ApiLimitReachedException;

class NullDriver implements Driver
{
    public function getName(): string
    {
        return 'null';
    }

    public function find(string $identifier, array $parameters = []): Product
    {
        if ($identifier === 'MOCK-AUTHENTICATION-FAILED') {
            throw new ApiAuthenticationFailedException(
                driver: $this,
            );
        }

        if ($identifier === 'MOCK-API-LIMIT-EXCEEDED') {
            throw new ApiLimitReachedException(
                driver: $this,
                limit: 10,
                period: 'minute',
            );
        }

        return new Product(
            identifier: $identifier,
            status: Status::Unknown,
            sku: 'null',
            name: 'Null product',
            description: 'A null product for the null driver',
            currency: null,
            url: null,
            price: null,
            unitAmount: null,
            unitPrice: null,

            // "relations"
            images: [],
            categories: [],
            brand: new Brand(
                identifier: 'null_brand',
                name: 'Null brand',
            ),

            raw: [],
        );
    }

    public function search(string $keywords, array $parameters = []): Results
    {
        return new Results(
            products: [],
        );
    }
}
