<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function addRoute($uri, $controller, $method)
    {
        $this->routes [] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public function get($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'GET');
    }

    public function post($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'POST');
    }

    public function put($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'PATCH');
    }

    public function delete($uri, $controller)
    {
        $this->addRoute($uri, $controller, 'DELETE');
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                return $route['controller'];
            }
        }
        return Router::abort(404);
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        exit('404 Not found');
    }
}


