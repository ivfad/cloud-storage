<?php

namespace Core;

class Route
{
    public function __construct(
        private $uri,
        private $method,
        private $controller,
        private $action
    )
    {
    }

    public static function get(string $uri, $controller, $action):static
    {
        return new static($uri, 'GET', $controller, $action);
    }

    public static function post(string $uri, $controller, $action):static
    {
        return new static($uri, 'POST', $controller, $action);
    }

    public function getUri():string
    {
        return $this->uri;
    }

    public function getMethod():string
    {
        return $this->method;
    }

    public function getController():string
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }
}