<?php

use Yaf\Application;

final class Environment
{
    public static function isProduction(): bool
    {
        return self::isEnvironment(__FUNCTION__);
    }

    public static function isNotProduction(): bool
    {
        return !self::isProduction();
    }

    public static function isLocal(): bool
    {
        return self::isEnvironment(__FUNCTION__);
    }

    private static function isEnvironment(string $environment): bool
    {
        $environment = strtolower($environment);
        $environment = str_replace('is', '', $environment);

        return Application::app()->environ() === $environment;
    }
}
