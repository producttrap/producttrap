<?php

declare(strict_types=1);

namespace ProductTrap\Contracts;

interface Factory
{
    /**
     * Get a ProductTrap driver implementation.
     *
     * @param  string  $driver
     * @return Driver
     */
    public function driver($driver = null);
}
