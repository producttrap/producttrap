<?php

declare(strict_types=1);

namespace ProductTrap;

use Illuminate\Support\Manager;
use ProductTrap\Contracts\BrowserFactory;
use ProductTrap\Drivers\NullBrowserDriver;

class ProductTrapBrowser extends Manager implements BrowserFactory
{
    public function createNullDriver(): NullBrowserDriver
    {
        return new NullBrowserDriver();
    }

    public function getDefaultDriver(): string
    {
        /** @var string|null $browser */
        $driver = $this->config->get('producttrap.browsers.default');

        if (! is_string($driver)) {
            throw new \InvalidArgumentException('A default ProductTrap browser driver has not been configured');
        }

        return $driver;
    }
}
