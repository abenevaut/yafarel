<?php

namespace App\Facades;

use App\Infrastructure\FacadeAbstract;

final class Config extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return 'config';
    }
}
