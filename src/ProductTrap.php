<?php

declare(strict_types=1);

namespace ProductTrap;

use Illuminate\Support\Manager;
use ProductTrap\Contracts\Factory;
use ProductTrap\Drivers\NullDriver;

class ProductTrap extends Manager implements Factory
{
    public function createNullDriver(): NullDriver
    {
        return new NullDriver();
    }

    public function getDefaultDriver(): string
    {
        /** @var string|null $driver */
        $driver = $this->config->get('producttrap.default');

        if (! is_string($driver)) {
            throw new \InvalidArgumentException('A default ProductTrap driver has not been configured');
        }

        return $driver;
    }
}
