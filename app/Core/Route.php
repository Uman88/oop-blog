<?php

namespace App\Core;

use App\Models\Posts;

class Route
{
    protected static $controller = 'site';
    protected static $method = 'index';
    protected static $params = [];


    public static function start()
    {
        $uri = parse_url($_SERVER['REQUEST_URI']);
        $routes = explode('/', $uri['path']);

        if (!empty($routes[1])) {
            self::$controller = $routes[1];
        }

        if (!empty($routes[2])) {
            self::$method = $routes[2];
        }

        if (count($routes) > 2) {
            self::$params = array_slice($routes, 2);
        }

        $controllerName = ucfirst(self::$controller) . 'Controller';
        $controllerFile = $controllerName . '.php';
        $controllerPath = dirname(__DIR__) . "/Controllers/" . $controllerFile;

        if (file_exists($controllerPath)) {
            include dirname(__DIR__) . "/Controllers/" . $controllerFile;
        } else {
            require_once '../app/Views/errors/404.php';
        }

        $controller = 'App\Controllers\\' . $controllerName;

        $controller = new $controller;
        $action = self::$method;

        self::$params = explode('?', $action);

        $action = self::$params[0];
//        $params = self::$params;
        $params = self::$params[1] ?? null;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            require_once '../app/Views/errors/404.php';
        }
    }

    public static function url()
    {

    }
}