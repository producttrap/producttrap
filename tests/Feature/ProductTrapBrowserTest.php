<?php

declare(strict_types=1);

use Illuminate\Contracts\Config\Repository;
use ProductTrap\Drivers\NullBrowserDriver;
use ProductTrap\DTOs\CrawlResult;
use ProductTrap\ProductTrapBrowser;

it('can instantiate ProductTrap browser', function () {
    expect($this->app->get(ProductTrapBrowser::class))->toBeInstanceOf(ProductTrapBrowser::class);
});

it('can add multiple browser drivers to ProductTrap', function () {
    $client = $this->app->get(ProductTrapBrowser::class);
    $client->extend('null2', function () {
        return new NullBrowserDriver();
    });

    expect($client)->driver('null2')->toBeInstanceOf(NullBrowserDriver::class);
});

it('can retrieve a browser driver from ProductTrap', function () {
    expect($this->app->get(ProductTrapBrowser::class))
        ->driver('null')->toBeInstanceOf(NullBrowserDriver::class);
});

it('throws an exception when a browser driver can\'t be found in ProductTrap', function () {
    $this->app->get(ProductTrapBrowser::class)->driver('abc');
})->throws(InvalidArgumentException::class);

it('can set a default ProductTrap browser driver', function () {
    config()->set('producttrap.browsers.default', 'null');

    $client = $this->app->get(ProductTrapBrowser::class);

    expect($client->getDefaultDriver())->toBe('null')
        ->and($client->driver())->toBeInstanceOf(NullBrowserDriver::class);
});

it('throws an exception when a default browser driver hasn\'t been set in ProductTrap', function () {
    $this->app->get(Repository::class)->set('producttrap.browsers.default', null);

    $this->app->get(ProductTrapBrowser::class)->driver();
})->throws(InvalidArgumentException::class, 'A default ProductTrap browser driver has not been configured');

it('can call `crawl` on a ProductTrap browser driver', function () {
    expect($this->app->get(ProductTrapBrowser::class)->driver('null')->crawl('https://example.org'))
        ->toBeInstanceOf(CrawlResult::class)
        ->result->toBe('Null HTML result')
        ->data->toBe([
            'this is a null browser result',
        ]);
});
