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
}
