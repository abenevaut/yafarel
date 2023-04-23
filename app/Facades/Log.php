<?php

namespace App\Facades;

use App\Infrastructure\SingletonFacadeAbstract;

final class Log extends SingletonFacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return 'log';
    }
}
