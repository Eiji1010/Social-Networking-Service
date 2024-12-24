<?php

namespace Middleware;

use Helpers\Authenticate;
use Middleware\Middleware;
use Response\FlashData;
use Response\HTTPRenderer;
use Response\Render\RedirectRenderer;

class AuthenticatedMiddleware implements Middleware
{

    public function handle(callable $next): HTTPRenderer
    {
        if (!Authenticate::isLoggedIn()){
            FlashData::setFlashData('error', 'You need to login to access this page');
            return new RedirectRenderer('login');
        }
        return $next();
    }
}