<?php

declare(strict_types=1);

use ProductTrap\Exceptions\ApiAuthenticationFailedException;
use ProductTrap\Exceptions\ApiLimitReachedException;
use ProductTrap\Facades\ProductTrap;

it('can build the exception class for when the api limit is exceeded', function () {
    $exception = null;

    try {
        ProductTrap::find('MOCK-API-LIMIT-EXCEEDED');
    } catch (ApiLimitReachedException $exception) {
    }

    expect($exception)->toBeInstanceOf(ApiLimitReachedException::class)
        ->and($exception->limit)->toBe(10)
        ->and($exception->period)->toBe('minute')
        ->and($exception->driver)->toBe(ProductTrap::driver())
        ->and($exception->driverName())->toBe('Null')
        ->and($exception->getMessage())->toBe('The API limit of 10 requests per minute has been reached for the Null driver');
});

it('can build the exception class for when the api authentication fails', function () {
    $exception = null;

    try {
        ProductTrap::find('MOCK-AUTHENTICATION-FAILED');
    } catch (ApiAuthenticationFailedException $exception) {
    }

    expect($exception)->toBeInstanceOf(ApiAuthenticationFailedException::class)
        ->and($exception->driver)->toBe(ProductTrap::driver())
        ->and($exception->driverName())->toBe('Null')
        ->and($exception->getMessage())->toBe('The API authentication failed for the Null driver');
});
