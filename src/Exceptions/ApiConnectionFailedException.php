<?php

namespace ProductTrap\Exceptions;

use ProductTrap\Contracts\Driver;
use Throwable;

class ApiConnectionFailedException extends ProductTrapDriverException
{
    public function __construct(
        Driver $driver,
        string $resourceOrUrl,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            driver: $driver,
            message: sprintf(
                'The connection to %s has failed for the %s driver',
                $resourceOrUrl,
                $driver->getName(),
            ),
            code: 503,
            previous: $previous,
        );
    }

    public static function create(Driver $driver, string $resourceOrUrl, ?Throwable $previous = null): self
    {
        return new self(
            driver: $driver,
            resourceOrUrl: $resourceOrUrl,
            previous: $previous,
        );
    }
}
