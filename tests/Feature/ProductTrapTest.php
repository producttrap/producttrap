<?php

declare(strict_types=1);

use Illuminate\Contracts\Config\Repository;
use ProductTrap\Drivers\NullBrowserDriver;
use ProductTrap\Drivers\NullDriver;
use ProductTrap\DTOs\Brand;
use ProductTrap\DTOs\Category;
use ProductTrap\DTOs\Product;
use ProductTrap\DTOs\Query;
use ProductTrap\DTOs\Results;
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
        ->sku->toBe('null')
        ->name->toBe('Null product');
});

it('can call `find` on the default ProductTrap driver', function () {
    $client = $this->app->get(ProductTrap::class);

    expect($client->find('abcdefg'))->toBeInstanceOf(Product::class);
});

it('can call `search` on a ProductTrap driver and pass in a search query', function () {
    $client = $this->app->get(ProductTrap::class)->driver('null');

    expect($client->search(Query::fromKeywords('blah')))
        ->toBeInstanceOf(Results::class)
        ->query->keywords->toBe('blah')
        ->query->brand->toBeNull()
        ->query->category->toBeNull()
        ->query->toString()->toBe('blah')
        ->products->toHaveCount(3);
});

it('can call `search` on a ProductTrap driver and pass in a brand query', function () {
    $client = $this->app->get(ProductTrap::class)->driver('null');
    $brand = new Brand(
        identifier: 'null_brand',
        name: 'Null brand',
    );

    expect($client->search(Query::fromBrand($brand)))
        ->toBeInstanceOf(Results::class)
        ->query->keywords->toBeNull()
        ->query->brand->toBe($brand)
        ->query->category->toBeNull()
        ->query->toString()->toBe('Null brand')
        ->products->toHaveCount(3);
});

it('can call `search` on a ProductTrap driver and pass in a category query', function () {
    $client = $this->app->get(ProductTrap::class)->driver('null');
    $category = new Category(
        identifier: 'null_category',
        name: 'Null category',
    );

    expect($client->search(Query::fromCategory($category)))
        ->toBeInstanceOf(Results::class)
        ->query->keywords->toBeNull()
        ->query->brand->toBeNull()
        ->query->category->toBe($category)
        ->query->toString()->toBe('Null category')
        ->products->toHaveCount(3);
});

it('can specify the current page of a ProductTrap driver in the context of a query', function () {
    $client = $this->app->get(ProductTrap::class)->driver('null');

    $client->page(2);
    $client->lastPage(4);

    expect($client)->toBeInstanceOf(NullDriver::class)
        ->getPage()->toBe(2)
        ->getLastPage()->toBe(4);
});

it('can specify the browser to be used when driver requires browser', function () {
    $client = $this->app->get(ProductTrap::class)->driver('null');
    $client->setBrowser($browser = new NullBrowserDriver());

    expect(true)->toBeTrue();
    // nothing to test
});
