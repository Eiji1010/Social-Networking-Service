<?php
session_start();
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/..');
require 'vendor/autoload.php';

$DEBUG = true;

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|html)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

$routes = include("Routing/routes.php");

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = ltrim($path, '/');

if (isset($routes[$path])){
    try{
        $route = $routes[$path];
        if (!($route instanceof Routing\Route)){
            throw new Exception("Invalid route handler.");
        }

        $middlewareRegister = include('Middleware/middleware-register.php');
        $middlewares = array_merge($middlewareRegister['global'], array_map(fn ($routeAlias) => $middlewareRegister['aliases'][$routeAlias], $route->getMiddleware()));
        $middlewareHandler = new \Middleware\MiddlewareHandler(array_map(fn($middlewareClass) => new $middlewareClass(), $middlewares));

        $renderer = $middlewareHandler->run($route->getCallback());

        foreach ($renderer->getFields() as $name=>$value){
            $sanitized_value = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            if ($sanitized_value  && $sanitized_value === $value){
                header(sprintf("%s: %s", $name, $value));
            }
            else{
                http_response_code(500);
                if ($DEBUG) print("Failed setting header - original: '$value', sanitized: '$sanitized_value'");
                exit;
            }
            print($renderer->getContent());
        }
    }
    catch (Exception $e){
        http_response_code(500);
        print("Internal error, please contact the admin.<br>");
        if($DEBUG) print($e->getMessage());
    }
}