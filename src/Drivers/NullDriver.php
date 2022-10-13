<?php

namespace ProductTrap\Drivers;

use ProductTrap\Contracts\Driver;
use ProductTrap\Contracts\SupportsPagination;
use ProductTrap\Contracts\SupportsSearches;
use ProductTrap\DTOs\Brand;
use ProductTrap\DTOs\Product;
use ProductTrap\DTOs\Query;
use ProductTrap\DTOs\Results;
use ProductTrap\Enums\Status;
use ProductTrap\Exceptions\ApiAuthenticationFailedException;
use ProductTrap\Exceptions\ApiLimitReachedException;

class NullDriver implements Driver, SupportsSearches, SupportsPagination
{
    protected int $page = 1;

    protected int $lastPage = 1;

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

    public function search(Query $query, array $parameters = []): Results
    {
        return new Results(
            query: $query,
            products: [
                $this->find('MOCK-PRODUCT-1'),
                $this->find('MOCK-PRODUCT-2'),
                $this->find('MOCK-PRODUCT-3'),
            ],
            raw: [],
        );
    }

    public function page(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function lastPage(int $lastPage): self
    {
        $this->lastPage = $lastPage;

        return $this;
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }
}
