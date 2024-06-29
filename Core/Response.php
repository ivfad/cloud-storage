<?php

namespace Core;

class Response
{
    public function __construct(
        private mixed $content,
        private int $statusCode = 200,
        private array $headers = [],
    )
    {
    }

    public function send(): void
    {
        echo $this->content;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setHeaders($headers = []): void
    {
        $this->headers = $headers;
    }

    public function setStatusCode($statusCode = 200): void
    {
        $this->statusCode = $statusCode;
    }
}