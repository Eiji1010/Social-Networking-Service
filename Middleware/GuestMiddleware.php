<?php

namespace Middleware;

use Helpers\Authenticate;
use Middleware\Middleware;
use Response\FlashData;
use Response\HTTPRenderer;
use Response\Render\RedirectRenderer;

class GuestMiddleware implements Middleware
{

    public function handle(callable $next): HTTPRenderer
    {
        error_log("Running GuestMiddleware");
        if(Authenticate::isLoggedIn()) {
            FlashData::setFlashData('error', 'You are already logged in. Please logout to access the page.');
            return new RedirectRenderer('homepage');
        }
        return $next();
    }
}