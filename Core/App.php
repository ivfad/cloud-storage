<?php

namespace Core;

class App
{
    protected static Container $container;

    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    public static function getContainer(): Container
    {
        return static::$container;
    }

    public static function bind(string $id, string|callable $resolver)
    {
        static::getContainer()->bind($id, $resolver);
    }

    public static function get($id)
    {
        return static::getContainer()->get($id);
    }
}