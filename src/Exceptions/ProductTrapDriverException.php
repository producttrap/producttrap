<?php

namespace ProductTrap\Exceptions;

use Exception;
use ProductTrap\Contracts\Driver;
use ProductTrap\Contracts\ProductTrapException;
use Throwable;

abstract class ProductTrapDriverException extends Exception implements ProductTrapException
{
    public function __construct(public readonly Driver $driver, string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(
            message: $message,
            code: $code,
            previous: $previous,
        );
    }
}
