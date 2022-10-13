<?php

namespace ProductTrap\Contracts;

use ProductTrap\DTOs\Product;
use ProductTrap\Exceptions\ApiAuthenticationFailedException;
use ProductTrap\Exceptions\ApiLimitReachedException;

interface Driver
{
    public function getName(): string;

    /**
     * @param  array<string, mixed>  $parameters
     *
     * @throws ApiAuthenticationFailedException
     * @throws ApiLimitReachedException
     */
    public function find(string $identifier, array $parameters = []): Product;
}
