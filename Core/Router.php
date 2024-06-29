<?php

namespace Core;

//require_once BASE_PATH . 'functions.php';

class Router
{

    protected array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];

    public function __construct()
    {
        $this->addRoutes();
    }

    private function addRoutes(): void
    {
        $routesList = $this->getRoutes();

        foreach ($routesList as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * Return routes from routes list
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require_once BASE_PATH.'routes.php';
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        exit('404 Not found');
    }

    public function route(string $uri, string $method): void
    {
        $currentRoute = $this->findRoute($uri, $method);

        if (! $currentRoute) {
            $this->abort(404);
        }

        $action = $currentRoute->getAction();

        if(is_array($action)){
            $action = $this->useController($currentRoute->getAction());
        }

        call_user_func($action);

    }

    public function useController($controller)
    {
        [$controller, $action] = $controller;
        $controller = new $controller; //Плохо, переосмыслить!

        return [$controller, $action];
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

}