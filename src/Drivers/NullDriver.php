<?php

namespace ProductTrap\Drivers;

use ProductTrap\Contracts\BrowserDriver;
use ProductTrap\Contracts\Driver;
use ProductTrap\Contracts\RequiresBrowser;
use ProductTrap\Contracts\SupportsPagination;
use ProductTrap\Contracts\SupportsSearches;
use ProductTrap\DTOs\Brand;
use ProductTrap\DTOs\Product;
use ProductTrap\DTOs\Query;
use ProductTrap\DTOs\Results;
use ProductTrap\Enums\Status;
use ProductTrap\Exceptions\ApiAuthenticationFailedException;
use ProductTrap\Exceptions\ApiLimitReachedException;

class NullDriver implements Driver, SupportsSearches, SupportsPagination, RequiresBrowser
{
    protected int $page = 1;

    protected int $lastPage = 1;

    protected ?BrowserDriver $browser = null;

    public function getName(): string
    {
        return 'null';
    }

    public function setBrowser(BrowserDriver $browser): self
    {
        $this->browser = $browser;

        return $this;
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

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function setLastPage(int $lastPage): self
    {
        $this->lastPage = $lastPage;

        return $this;
    }

    public function lastPage(): int
    {
        return $this->lastPage;
    }
}
