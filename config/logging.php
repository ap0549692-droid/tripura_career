<?php

use Monolog\Handler\StreamHandler;

return [
    'default' => 'stderr',

    'deprecations' => [
        'channel' => null,
        'trace' => false,
    ],

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['stderr'],
        ],
        'single' => [
            'driver' => 'single',
            'path' => '/tmp/laravel.log',
            'level' => 'debug',
        ],
        'stderr' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => StreamHandler::class,
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],
    ],
];
