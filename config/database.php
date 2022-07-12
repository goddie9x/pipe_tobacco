<?php
$connectionInfo = [
    'default' => [
        'driver' => env('PIPE_TOBACCO_DRIVER', 'mysql'),
        'host' => env('PIPE_TOBACCO_HOST', 'localhost'),
        'database' => env('PIPE_TOBACCO_DB_NAME', 'forge'),
        'username' => env('PIPE_TOBACCO_USER', 'forge'),
        'password' => env('PIPE_TOBACCO_PASSWORD', ''),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
    ],
    'pipe_tobacco' => [
        'driver' => env('PIPE_TOBACCO_DRIVER', 'mysql'),
        'host' => env('PIPE_TOBACCO_HOST', 'localhost'),
        'database' => env('PIPE_TOBACCO_DB_NAME', 'forge'),
        'username' => env('PIPE_TOBACCO_USER', 'forge'),
        'password' => env('PIPE_TOBACCO_PASSWORD', ''),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
    ],
];

