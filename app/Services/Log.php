<?php

namespace App\Services;

use Yaf\Registry;

final class Log
{
    public static function debug(string $message, array $context = []): void
    {
        self::log(__FUNCTION__, $message, $context);
    }
    
    public static function info(string $message, array $context = []): void
    {
        self::log(__FUNCTION__, $message, $context);
    }

    public static function warn(string $message, array $context = []): void
    {
        self::log(__FUNCTION__, $message, $context);
    }

    public static function error(string $message, array $context = []): void
    {
        self::log(__FUNCTION__, $message, $context);
    }

    private static function log(string $level, $message, $context = []): void
    {
        Registry::get('log')->{$level}($message, $context);
    }
}
