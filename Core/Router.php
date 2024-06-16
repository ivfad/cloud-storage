<?php

namespace Core;

//require_once BASE_PATH . 'functions.php';

class Router
{

    protected array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
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
//            $this->routes[$route->getMethod()] = $route;
        }
    }

    /**
     * Return routes from routes list
     * @return array
     */
    private function getRoutes(): array
    {
        return require_once BASE_PATH.'routes.php';
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        exit('4044444 Not found');
    }

    public function route(string $uri, string $method): void
    {
        $currentRoute = $this->findRoute($uri, $method);

        if (! $currentRoute) {
            $this->abort();
        }
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    public function test()
    {
        dd($this->routes);
    }


}