<?php

declare(strict_types=1);

use Illuminate\Contracts\Config\Repository;
use ProductTrap\Drivers\NullDriver;
use ProductTrap\DTOs\Product;
use ProductTrap\Enums\Status;
use ProductTrap\ProductTrap;

it('can instantiate ProductTrap', function () {
    expect($this->app->get(ProductTrap::class))->toBeInstanceOf(ProductTrap::class);
});

it('can add multiple drivers to ProductTrap', function () {
    $client = $this->app->get(ProductTrap::class);
    $client->extend('null2', function () {
        return new NullDriver();
    });

    expect($client)->driver('null2')->toBeInstanceOf(NullDriver::class);
});

it('can retrieve a driver from ProductTrap', function () {
    expect($this->app->get(ProductTrap::class))
        ->driver('null')->toBeInstanceOf(NullDriver::class);
});

it('throws an exception when a driver can\'t be found in ProductTrap', function () {
    $this->app->get(ProductTrap::class)->driver('abc');
})->throws(InvalidArgumentException::class);

it('can set a default ProductTrap driver', function () {
    config()->set('producttrap.default', 'null');

    $client = $this->app->get(ProductTrap::class);

    expect($client->getDefaultDriver())->toBe('null')
        ->and($client->driver())->toBeInstanceOf(NullDriver::class);
});

it('throws an exception when a default driver hasn\'t been set in ProductTrap', function () {
    $this->app->get(Repository::class)->set('producttrap.default', null);

    $this->app->get(ProductTrap::class)->driver();
})->throws(InvalidArgumentException::class, 'A default ProductTrap driver has not been configured');

it('can call `find` on a ProductTrap driver', function () {
    expect($this->app->get(ProductTrap::class)->driver('null')->find('abcdefg'))
        ->toBeInstanceOf(Product::class)
        ->identifier->toBe('abcdefg')
        ->status->toBe(Status::Unknown)
        ->status->description()->toBe('Unknown')
        ->summary->toBe('This is a summary for the null driver')
        ->estimatedDelivery->toEqual(new DateTimeImmutable('2022-01-01'));
});

it('can call `find` on the default ProductTrap driver', function () {
    $client = $this->app->get(ProductTrap::class);

    expect($client->find('abcdefg'))->toBeInstanceOf(Product::class);
});
