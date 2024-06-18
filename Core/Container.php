<?php

namespace Core;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    protected array $bindings = [];

    public function bind(string $id, callable $resolver): void
    {
        $this->bindings[$id] = $resolver;
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }

    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ServiceNotFoundException("No matching binding for {$id}");
        }

        $resolver = $this->bindings[$id];

        return call_user_func($resolver);
    }
}