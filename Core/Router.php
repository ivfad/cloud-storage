<?php

namespace Core;

//require_once BASE_PATH . 'functions.php';

class Router
{

    protected array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct()
    {
        $this->addRoutes();
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

    private function addRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    private function getRoutes(): array
    {
        return require_once BASE_PATH.'routes.php';
    }
}