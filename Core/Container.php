<?php

namespace Core;
use Psr\Container\ContainerInterface;

class Container extends Singleton implements ContainerInterface
{
    protected array $bindings = [];

    public function bind(string $id, string|callable $resolver): void
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

//        $resolver = $this->bindings[$id] ?? $id;

//        if (is_callable($resolver)) {
//            return call_user_func($resolver);
//        }

        return $this->createInstance($id);
    }

    public function checkInstantiability($class)
    {
        $reflection = new \Reflectionclass($class);
        if (!$reflection->isInstantiable()) {
            throw new \Exception("{$class} is not instantiable");
        }
        return $reflection;
    }

    public function createInstance($id)
    {

        $reflection = new \ReflectionClass($id);
        $constructor = $reflection->getConstructor();

        if(isset($this->bindings[$id]) && is_callable($this->bindings[$id])) {
            $resolver = $this->bindings[$id];

            return call_user_func($resolver);
        }

        if(empty($constructor) && $reflection->isInstantiable()) return new $id;
        try {
            $this->checkInstantiability($id);
        } catch (\Exception $e) {
        }

        $parameters = $constructor->getParameters();
        $parametersList = [];
        if(empty($constructor) && !isset($this->bindings[$id])) {
            throw new \Exception("{$id} is not instantiable");
        }

        if(empty($parameters)) return new $id;

        foreach ($parameters as $parameter) {
            if(!$parameter->getType() && !$parameter->isOptional()) {
                throw new \Exception("{$parameter->getName()} for {$id} is not instantiable");
            }
            $parametersList []= $this->createInstance($parameter->getType()->getName());
        }

        return new $id(...$parametersList);
    }
}