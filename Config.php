<?php

class Config
{
    public function __construct(
        public string $host = 'localhost',
        public int $port = 3307,
        public string $dbname = 'cloud',
        public string $charset = 'utf8mb4')
    {
    }
}
