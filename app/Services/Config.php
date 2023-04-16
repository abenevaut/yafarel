<?php

namespace App\Services;

use Yaf\Registry;

final class Config
{
    public static function get(string $key): mixed
    {
        return Registry::get('config')->get($key);
    }
}
