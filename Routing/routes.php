<?php
namespace Routing;

use Response\Render\HTMLRenderer;
use Routing\Routing;

return [
    'login' => Routing::create('login', function() {
        return new HTMLRenderer('page/login', []);
    })
];