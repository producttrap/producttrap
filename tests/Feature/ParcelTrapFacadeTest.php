<?php

declare(strict_types=1);

use ProductTrap\DTOs\Product;
use ProductTrap\Facades\ProductTrap;

it('can call methods via the ProductTrap facade', function () {
    expect(ProductTrap::find('ABCDEFG'))
        ->toBeInstanceOf(Product::class)
        ->identifier->toBe('ABCDEFG');
});
