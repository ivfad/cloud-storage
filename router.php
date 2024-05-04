<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'This is \'/\' page',
    '/about' => 'This is \'/about\' page',
    '/test' => 'This is \'/test\' page',
];

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        echo $routes[$uri];
    } else {
        abort();
    }
}

function abort($code = 404)
{
    http_response_code($code);
    die('404 Not found');
}

routeToController($uri, $routes);
