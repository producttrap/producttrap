<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default ProductTrap Driver Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the ProductTrap drivers below you wish
    | to use as your default connection for all product work. Of course
    | you may use many drivers at once using the ProductTrap library.
    |
    */

    'default' => env('PRODUCTTRAP_DEFAULT_DRIVER'),

    /*
    |--------------------------------------------------------------------------
    | ProductTrap Drivers
    |--------------------------------------------------------------------------
    |
    | Here are each of the ProductTrap drivers setup for your application.
    |
    */

    'drivers' => [

        // ...

    ],

    /*
    |--------------------------------------------------------------------------
    | ProductTrap Browsers
    |--------------------------------------------------------------------------
    |
    | Here are the settings for the ProductTrap browsers for your application.
    |
    */

    'browsers' => [

        /*
        |--------------------------------------------------------------------------
        | Default ProductTrap Browser Name
        |--------------------------------------------------------------------------
        |
        | Here you may specify which of the ProductTrap browsers below you wish
        | to use as your default browser for all product work.
        |
        */

        'default' => env('PRODUCTTRAP_DEFAULT_BROWSER'),

        /*
        |--------------------------------------------------------------------------
        | ProductTrap Browsers
        |--------------------------------------------------------------------------
        |
        | Here are each of the ProductTrap browsers setup for your application.
        |
        */

        'drivers' => [

            // ...

        ],

    ],

];
