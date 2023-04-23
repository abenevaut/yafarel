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
        return Registry::get(static::getFacadeAccessor());
    }
}
