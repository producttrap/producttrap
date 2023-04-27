<?php

declare(strict_types=1);

namespace ProductTrap\Facades;

use Illuminate\Support\Facades\Facade;
use ProductTrap\Contracts\Driver;
use ProductTrap\DTOs\Product;

/**
 * @method static Driver driver(string|null $driver = null)
 * @method static Product find(string $identifier, array $parameters = [])
 */
class ProductTrap extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ProductTrap\ProductTrap::class;
    }
}
