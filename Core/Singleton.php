<?php

namespace Core;

abstract class Singleton
{
    protected static array $instances = [];
    protected function __construct() {
    }

    protected function __clone() {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): Singleton
    {
        $class = static::class;
        if(!isset(self::$instances[$class])) {
            self::$instances [$class] = new static();
        }
        return self::$instances[$class];
    }
}