<?php

declare(strict_types=1);

namespace ProductTrap\Tests;

use ProductTrap\Facades\ProductTrap;
use ProductTrap\ProductTrapServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [ProductTrapServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'ProductTrap' => ProductTrap::class,
        ];
    }
}
