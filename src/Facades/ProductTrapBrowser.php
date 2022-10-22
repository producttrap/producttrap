<?php

declare(strict_types=1);

namespace ProductTrap\Facades;

use Illuminate\Support\Facades\Facade;

/** @mixin \ProductTrap\ProductTrapBrowser */
class ProductTrapBrowser extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ProductTrap\ProductTrapBrowser::class;
    }
}
