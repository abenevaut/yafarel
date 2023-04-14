<?php

namespace App\Services;

use Yaf\Application;
use Yaf\Config\Simple;

final class Config
{
    public static function get(string $key): mixed
    {
        return Application::app()->getConfig()->get($key);
    }

    public static function set(string $key, mixed $value): void
    {
        Application::app()->getConfig()->set($key, $value);
    }
}
