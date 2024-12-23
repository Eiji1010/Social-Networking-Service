<?php

namespace Middleware;

use Middleware\Middleware;
use Response\HTTPRenderer;

class SessionsSetupMiddleware implements Middleware
{

    public function handle(callable $next): HTTPRenderer
    {
        session_start();
        return $next();
    }
}