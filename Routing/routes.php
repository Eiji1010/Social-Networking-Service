<?php
namespace Routing;

use Database\DAOFactory;
use Exception;
use Helpers\Authenticate;
use Models\User;
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
        return new RedirectRenderer('homepage');
    }),

    'logout' => Route::create('logout', function() {
        Authenticate::logoutUser();
        return new RedirectRenderer('login');
    }),

    'register' => Route::create('register', function() {
        return new HTMLRenderer('page/register', []);
    }),

    'form/register' => Route::create('/form/register', function (){
        if (!$_SERVER["REQUEST_METHOD"] === 'POST') throw new Exception('Invalid request method: ' . $_SERVER["REQUEST_METHOD"]);

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordConfirmation = $_POST['confirm-password'] ?? '';

        if($password !== $passwordConfirmation) throw new Exception('Password and password confirmation do not match.');

        $userDao = DAOFactory::getUserDAO();
        $user = new User(username: $username, email: $email);

        $success = $userDao->create($user, $password);
        if(!$success) throw new Exception('Failed to create user.');

        Authenticate::loginAsUser($user);
        error_log('User created: ' . json_encode($user));
        return new RedirectRenderer('login');
    }),

    'homepage' => Route::create('homepage', function(){
        return new HTMLRenderer('page/homepage', []);
    })
];