<?php

declare(strict_types=1);

namespace ProductTrap;

use Illuminate\Contracts\Container\Container;
use ProductTrap\Contracts\Driver;
use ProductTrap\Contracts\Factory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ProductTrapServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('producttrap')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(ProductTrap::class);
        $this->app->alias(ProductTrap::class, Factory::class);

        $this->app->bind(Driver::class, function (Container $app) {
            return $app->make(Factory::class)->driver(); // @phpstan-ignore-line
        });
    }
}
