<?php

declare(strict_types=1);

namespace ProductTrap\Contracts;

interface BrowserFactory
{
    /**
     * Get a ProductTrap browser driver implementation.
     *
     * @param  string  $driver
     * @return BrowserDriver
     */
    public function driver($driver = null);
}
