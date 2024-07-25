<?php

namespace Core;

class Response
{
    public function __construct(
        private mixed $content,
        private int $statusCode = 200,
        private string $headers = '',
    )
    {
    }

    public function send(): void
    {
        header($this->headers);
        http_response_code($this->statusCode);
        echo $this->content;
        exit();
    }

    public function json(): Response
    {
        $this->setHeaders('Content-Type: application/json, charset: utf-8');
        $this->setContent(json_encode($this->content));
        return $this;
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