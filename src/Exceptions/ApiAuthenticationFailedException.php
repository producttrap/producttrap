<?php

namespace ProductTrap\Exceptions;

use ProductTrap\Contracts\Driver;
use Throwable;

class ApiAuthenticationFailedException extends ProductTrapDriverException
{
    public function __construct(
        Driver $driver,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            driver: $driver,
            message: sprintf(
                'The API authentication failed for the %s driver',
                $driver->getName(),
            ),
            code: 403,
            previous: $previous,
        );
    }

    public static function create(Driver $driver, ?Throwable $previous = null): self
    {
        return new self(
            driver: $driver,
            previous: $previous,
        );
    }
}
