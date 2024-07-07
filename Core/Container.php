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
            $this->checkInstantiability($id);
        }

        //Case 1.1, when the object is associated with container, and its resolver is callable just call user func
        if($this->has($id) && is_callable($this->bindings[$id])) {
            return call_user_func($this->bindings[$id]);
        }

        //Case 1.2, when the object is associated with container, and it is singleton (its resolver is object)
        if($this->has($id) && is_object($this->bindings[$id])) {
            return $this->bindings[$id];
        }

        return $this->createInstance($id);
    }

    //Check if the $class could be instantiated
    protected function checkInstantiability($class)
    {
        $reflection = new \Reflectionclass($class);
//        echo $reflection;
        if (!$reflection->isInstantiable()) {
            throw new ItemInstantiabilityException("{$class} is not instantiable");
        }

        return $class;
    }

    //Create instance of the object
    protected function createInstance($id)
    {

        //Case 2.1 (repeated 1.1, rework), when the object is associated with container, and its resolver is callable
        if($this->has($id) && is_callable($this->bindings[$id])) {
            $resolver = $this->bindings[$id];
            return call_user_func($resolver);
        }

        //Case 2.2 (repeated 1.2, rework), when the object is associated with container, and it is singleton (its resolver is object)
        if($this->has($id) && is_object($this->bindings[$id])) {
            return $this->bindings[$id];
        }

//        if (!$this->has($id)) {
//            $this->checkInstantiability($id);
//        }

        $reflection = new \ReflectionClass($id);
//        $reflection = new \Reflectionclass($class);
        $constructor = $reflection->getConstructor();

        //Case 2.3, when the object has empty constructor, and its instantiable - this class has no dependencies
        if(empty($constructor) && $reflection->isInstantiable()) return new $id;

        //Case 2.4, this case is used, when $id is abstract class or interface, and bindings[$id] can be instantiable
        if(empty($constructor) && isset($this->bindings[$id]))
        {
            $id = $this->bindings[$id];
            return $this->createInstance($id);
        }

        //Case 2.5, when the object without constructor has no implementations or extentions in container
        if(!$constructor && !isset($this->bindings[$id])) {
            throw new \Exception("{$id} is not instantiable");
        }

        $parameters = $constructor->getParameters();
        $parametersList = [];

        //Case 2.6, when there are no parameters in the constructor
        if(empty($parameters)) return new $id;

        //Case 2.7, when there are any parameters in the constructor, recursively check and add to list every parameter instance
        foreach ($parameters as $parameter) {

            if(!$parameter->getType() && !$parameter->isOptional()) {
                throw new \Exception("{$parameter->getName()} for {$id} is not instantiable");
            }
            $parametersList []= $this->createInstance($parameter->getType()->getName());

        }

        return new $id(...$parametersList);
    }
}