<?php

namespace Core;

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

    public function route(Request $request): void
    {
        $currentRoute = $this->findRoute($request->uri(), $request->method());
        if (! $currentRoute) {
            $this->abort(404);
        }

        $action = $currentRoute['route']->getAction();
        $params = [];
        if(is_array($action)) {
            $params  = $currentRoute['params'];
            $action = $this->useController($action);
        }
            call_user_func($action, $params);
    }

    public function useController($controller)
    {
        [$controller, $action] = $controller;
        $controller = new $controller; //Seems not good. Mb rework later

        return [$controller, $action];
    }

    private function findRoute(string $uri, string $method): ?array
    {
        $params = [];
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            return ['route' => $route, 'params' => $params];
        }

        [$route, $params] =  $this->getRouteWithParams($uri, $method);

        if ($route && $params) {
            return ['route' => $route, 'params' => $params];
        }

        return null;
    }

    //Check if the route has parameters, like 'id' and 'name' in uri /example/{id}/{name}
    private function getRouteWithParams(string $uri, string $method): ?array
    {
        $uriParts = explode('/', $uri);
        array_shift($uriParts); // trims the first empty element

        foreach($this->routes[$method] as $savedRoute) {
            $parameters = [];
            $savedRouteParts = explode('/', $savedRoute->getUri());
            array_shift($savedRouteParts);

            if(count($uriParts) !== count($savedRouteParts)) {
                continue;
            }

            for ($i = 0; $i < count($savedRouteParts); $i++) {
                $routePart = $savedRouteParts[$i];
                $uriPart = $uriParts[$i];

                if ($uriPart === $routePart) continue;
                if ($uriPart == '') continue 2;

                if (preg_match("/[{][\w]+[}]/", $routePart)) {
                    $characters = ['{', '}'];
                    $routePart = str_replace($characters, '', $routePart);
                    $parameters[$routePart] = $uriParts[$i];
                } else {
                    continue 2;
                }
            }
            $route = $this->routes[$method][$savedRoute->getUri()];
            return [$route, $parameters];
        }

        return null;
    }

}