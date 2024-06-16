<?php

namespace Core;

class Response
{
    public function __construct(
        private mixed $content,
        private int $statusCode = 200,
        private array $header = [],
    )
    {
    }

    public function send(): void
    {
        echo $this->content;
    }
}