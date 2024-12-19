<?php
namespace Routing;

use Exception;
use Helpers\Authenticate;
use Response\Render\HTMLRenderer;
use Response\Render\RedirectRenderer;

return [
    'login' => Route::create('login', function() {
        return new HTMLRenderer('page/login', []);
    }),

    'form/login' => Route::create('/form/login', function() {
        if (!$_SERVER["REQUEST_METHOD"] === 'POST') throw new Exception('Invalid request method: ' . $_SERVER["REQUEST_METHOD"]);

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        Authenticate::authenticate($email, $password);
        return new RedirectRenderer('login');
    }),

    'logout' => Route::create('logout', function() {
        Authenticate::logoutUser();
        return new RedirectRenderer('login');
    }),
];