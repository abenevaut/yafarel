<?php

namespace App\Facades;

use App\Infrastructure\SingletonFacadeAbstract;

final class DB extends SingletonFacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return 'database';
    }
}
