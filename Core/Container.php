<?php

namespace Core;

class Container
{
    protected array $bindings = [];

    public function bind(string $id, object $service): void
    {
        $this->bindings[$id] = $service;
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new \Exception("No matching binding {$id}");
        }
        return call_user_func($this->bindings[$id]);
    }
}