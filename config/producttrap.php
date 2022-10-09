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

        // 'royal_mail' => [
        //     'client_id' => env('PRODUCTTRAP_ROYAL_MAIL_CLIENT_ID'),
        //     'client_secret' => env('PRODUCTTRAP_ROYAL_MAIL_CLIENT_SECRET'),
        //     'accept_terms' => env('PRODUCTTRAP_ROYAL_MAIL_ACCEPT_TERMS', true),
        // ],

    ],

];
