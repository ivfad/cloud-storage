<?php

namespace Core;

abstract class Singleton
{
    /**
     * Singleton pattern implementation
     * @return static
     */
    protected static array $instances = [];

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Singleton
    {

        $class = static::class;

        if(!isset(static::$instances[$class])) {
            static::$instances[$class] = new static();
        }

        return static::$instances[$class];
    }
}