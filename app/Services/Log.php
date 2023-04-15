<?php

namespace App\Services;

use Yaf\Registry;

final class Log
{
    public static function __callStatic(string $level, $arguments): void
    {
        Registry::get('log')->{$level}($arguments[0], $arguments[1] ?? []);
    }
}
