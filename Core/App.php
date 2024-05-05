<?php

namespace Core;

class App
{
    protected static Container $container;

    public static function setContainer(Container $container)
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }
}