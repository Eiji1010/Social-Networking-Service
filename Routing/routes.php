<?php
namespace Routing;

use Response\Render\HTMLRenderer;

return [
    'login' => Route::create('login', function() {
        return new HTMLRenderer('page/login', []);
    })
];