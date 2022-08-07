<?php
return [
    'enviroment' => env('APP_ENV', 'production'),
    'providers' => [
        'App\Providers\AppProvider'
    ],
    'models' => [
        'App\Models'
    ],
    'controllers' => [
        'App\Controllers'
    ],
    'views' => [
        'App\Views'
    ],
    'middlewares' => [
        'App\Middlewares'
    ],
    'routes' => [
        'App\Routes'
    ]
];