<?php

namespace Core;
use Psr\Container\ContainerInterface;
use Core\ItemInstantiabilityException;

class Container extends Singleton implements ContainerInterface
{
    protected array $bindings = [];

    //Associate a common-class object (ClassName::class, Params) to the bindings array of the container
    public function bind(string $id, string|callable $resolver): Container
    {
        $this->bindings[$id] = $resolver;
        return $this;
    }

    //Associate a singleton-class object (ClassName::class, ClassObject) to the bindings array of the container
    public function singleton(string $id, object $instance): Container
    {
        $this->bindings[$id] = $instance;
        return $this;
    }

    //Check if the object(ClassName:class) is already associated to the bindings array
    public function has(string $id): bool
    {
        return isset($this->bindings[$id]);
    }

    //Get the object out of the container
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ServiceNotFoundException("No matching binding for {$id}");
        }

        return $this->createInstance($id);
    }

    //Check if the $class could be instantiated
    public function checkInstantiability($class): \ReflectionClass
    {
        $reflection = new \Reflectionclass($class);

        if (!$reflection->isInstantiable()) {
            throw new ItemInstantiabilityException("{$class} is not instantiable");
        }
        dd(123);
        return $reflection;
    }

    //Create instance of the object
    public function createInstance($id)
    {

        //Case 1, when the object is associated with container, and its resolver is callable
        if(isset($this->bindings[$id]) && is_callable($this->bindings[$id])) {
            $resolver = $this->bindings[$id];

            return call_user_func($resolver);
        }

//            $reflection = $this->checkInstantiability($id);
        try {
            $reflection = $this->checkInstantiability($id);
        } catch (\Exception $e) {}
        $reflection = new \ReflectionClass($id);
        $constructor = $reflection->getConstructor();
        //Case 2, when the object is associated with container, and it is singleton (its resolver is object)
        if(is_object($this->bindings[$id]))
        {
            return $this->bindings[$id];
        }

        //Case 3, when the object has empty constructor
        if(empty($constructor)) return new $id;

        $parameters = $constructor->getParameters();
        $parametersList = [];

        //Case 4, when there are no parameters in the constructor
        if(empty($parameters)) return new $id;

        //Case 5, when there are any parameters in the constructor, recursively check and add to list every parameter instance
        foreach ($parameters as $parameter) {
            if(!$parameter->getType() && !$parameter->isOptional()) {
                throw new \Exception("{$parameter->getName()} for {$id} is not instantiable");
            }
            $parametersList []= $this->createInstance($parameter->getType()->getName());
        }

        return new $id(...$parametersList);
    }
}