<?php
return [
    'global' => [
        \Middleware\SessionsSetupMiddleware::class,
        \Middleware\CSRFMiddleware::class,
    ],
    'aliases' => [
        'guest' => \Middleware\GuestMiddleware::class,
        'auth' => \Middleware\AuthenticatedMiddleware::class,
    ]
];
