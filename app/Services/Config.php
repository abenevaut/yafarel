<?php

namespace App\Services;

use Yaf\Application;
use Yaf\Config\Simple;

final class Config
{
    public static function get(string $key): mixed
    {
        return Application::getConfig()->get($key);
    }

    public static function set(string $key, $value): void
    {
        Application::getConfig()->set($key, $value);
    }
}
