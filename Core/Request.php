<?php

namespace Core;
/* Упрощенный аналог Symphony HttpFoundation */
class Request
{

    /**
     * @param array $getParams The GET parameters
     * @param array $postParams The POST parameters
     * @param array $cookies The COOKIE parameters
     * @param array $files The FILES parameters
     * @param array $server The SERVER parameters
     */
    public function __construct(
        private readonly array $getParams,
        private readonly array $postParams,
        private readonly array $cookies,
        private readonly array $files,
        private readonly array $server,
    )
    {
    }

    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    public function get()
    {
       return $this->getParams;
    }

    public function uri()
    {
        return parse_url($this->server['REQUEST_URI'])['path'] ?? '/';
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }
}