<?php
namespace Routing;

use Response\Render\HTMLRenderer;
use Response\Render\RedirectRenderer;

return [
    'login' => Route::create('login', function() {
        return new HTMLRenderer('page/login', []);
    }),

    'form/login' => Route::create('/form/login', function() {
        return new RedirectRenderer('login');
    }),
];