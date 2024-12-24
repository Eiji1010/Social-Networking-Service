<?php

namespace Middleware;

use Middleware\Middleware;
use Response\FlashData;
use Response\HTTPRenderer;
use Response\Render\RedirectRenderer;

class CSRFMiddleware implements Middleware
{

    public function handle(callable $next): HTTPRenderer
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $token = $_SESSION['csrf_token'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if ($_POST['csrf_token'] !== $token){
                FlashData::setFlashData('error', 'Access has been denied');
                return new RedirectRenderer('login');
            }
        }
        return $next();
    }
}