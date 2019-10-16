<?php

return [

    /*
    |--------------------------------------------------------------------------
    | APPLICATION APIS
    |--------------------------------------------------------------------------
    |
    | This value is the name of your API application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
 */

    "version" => env("APP_API_VERSION", "v1"),
    "key" => env("APP_API_KEY"),

    /**
     * Version 1 of API
     */
        "v1" => [
            "name" => "Version 1",
            "namespace" => "App\Http\Controllers\Api\V1",
            "routes" => base_path("routes/api/v1/*.php")
        ]
    
];
