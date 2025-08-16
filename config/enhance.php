
<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Enhance API Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for the Enhance API client.
    |
    */

    'base_url' => env('ENHANCE_API_URL', ''),

    'api_key' => env('ENHANCE_API_TOKEN'),

    'default_organization' => env('ENHANCE_API_ORGANIZATION', ''),

    'timeout' => env('ENHANCE_API_TIMEOUT', 30),

    'retry' => [
        'times' => env('ENHANCE_API_RETRY_TIMES', 3),
        'sleep' => env('ENHANCE_API_RETRY_SLEEP', 1000),
    ],
];
