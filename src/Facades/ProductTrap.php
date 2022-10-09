<?php

declare(strict_types=1);

namespace ProductTrap\Facades;

use Illuminate\Support\Facades\Facade;

/** @mixin \ProductTrap\ProductTrap */
class ProductTrap extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ProductTrap\ProductTrap::class;
    }
}
