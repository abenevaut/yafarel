<?php

namespace App\Infrastructure;

use Yaf\Registry;

abstract class FacadeAbstract
{
    abstract protected static function getFacadeAccessor(): string;

    public static function __callStatic(string $method, array $args): mixed
    {
        return static::getInstance()->{$method}(...$args);
    }

    protected static function getInstance(): mixed
    {
        $instantiableClass = static::getFacadeAccessor();
        $instance = Registry::get($instantiableClass);

        // Create instance on first demand
        if (class_exists($instantiableClass) && $instance instanceof \Closure) {
            $callable = Registry::get($instantiableClass);
            $instance = $callable();
            // Free \Closure from registry
            Registry::del($instantiableClass);
            // Register instance to registry
            Registry::set($instantiableClass, $instance);
        }

        return $instance;
    }
}
