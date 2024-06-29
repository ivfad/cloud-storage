<?php

namespace Core;

class Route
{
    public function __construct(
        private $uri,
        private $method,
        private $action
    )
    {
    }

    public static function get(string $uri, $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public static function post(string $uri, $action): static
    {
        return new static($uri, 'POST', $action);
    }

    public static function put(string $uri, $action): static
    {
        return new static($uri, 'PUT', $action);
    }

    public static function delete(string $uri,$action): static
    {
        return new static($uri, 'DELETE', $action);
    }

    public function getUri():string
    {
        return $this->uri;
    }

    public function getMethod():string
    {
        return $this->method;
    }

//    public function getController():string
//    {
//        return $this->controller;
//    }

    public function getAction()
    {
        return $this->action;
    }
}