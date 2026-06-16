<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Love Thai Home API
    |--------------------------------------------------------------------------
    |
    | External API credentials (see Postman collection).
    | Base URL should include the API version prefix, e.g. /api/v1
    |
    */

    'base_url' => rtrim(env('LOVE_THAI_HOME_API_URL', 'https://lovethaihome.com/api/v1'), '/'),

    'token' => env('LOVE_THAI_HOME_API_TOKEN'),

    'timeout' => (int) env('LOVE_THAI_HOME_API_TIMEOUT', 15),

    'retry' => [
        'times' => (int) env('LOVE_THAI_HOME_API_RETRY_TIMES', 2),
        'sleep_ms' => (int) env('LOVE_THAI_HOME_API_RETRY_SLEEP_MS', 200),
    ],

    'cache_ttl' => (int) env('LOVE_THAI_HOME_API_CACHE_TTL', 3600),

];
