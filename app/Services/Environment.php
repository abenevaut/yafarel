<?php

namespace App\Services;

use Yaf\Application;
use Yaf\Config\Simple;

final class Environment
{
    public static function isProduction(): bool
    {
        return self::isEnvironment(str_replace('is', '', strtolower(__FUNCTION__)));
    }

    public static function isLocal(): bool
    {
        return self::isEnvironment(str_replace('is', '', strtolower(__FUNCTION__)));
    }

    public static function isEnvironment(string $environment): bool
    {
        return Application::app()->environ() === $environment
            OR (bool) getenv('APP_ENV') === $environment;
    }
}
