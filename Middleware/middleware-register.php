<?php
return [
    'global' => [
        \Middleware\SessionsSetupMiddleware::class,
    ],
    'aliases' => [
        'guest' => \Middleware\GuestMiddleware::class,
    ]
];
