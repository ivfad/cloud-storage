<?php

namespace Core;

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

    /**
     * Create a request based on the current PHP global variables
     * @return static
     */
    public static function createFromGlobals(): static
    {
        return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    /**
     * Getter of the $_GET parameters of current request
     * @return array
     */
    public function get(): array
    {
       return $this->getParams;
    }

    /**
     * Getter of the $_POST parameters of current request
     * @return array
     */
    public function post(): array
    {
        return $this->postParams;
    }


    /**
     * Parse request URL and return its path
     * @return string
     */
    public function uri(): string
    {
        return parse_url($this->server['REQUEST_URI'])['path'] ?? '/';
    }


    /**
     * Get current request's method
     * @return string
     */
    public function method(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }
}