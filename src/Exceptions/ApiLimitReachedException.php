<?php

namespace ProductTrap\Exceptions;

use ProductTrap\Contracts\Driver;
use Throwable;

class ApiLimitReachedException extends ProductTrapDriverException
{
    public function __construct(
        Driver $driver,
        public readonly int $limit,
        public readonly string $period,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            driver: $driver,
            message: sprintf(
                'The API limit of %s requests per %s has been reached for the %s driver',
                $limit,
                $period,
                self::getDriverName($driver),
            ),
            code: 429,
            previous: $previous,
        );
    }

    public static function create(Driver $driver, int $limit, string $period, ?Throwable $previous = null): self
    {
        return new self(
            driver: $driver,
            limit: $limit,
            period: $period,
            previous: $previous,
        );
    }
}
