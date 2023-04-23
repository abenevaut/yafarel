<?php

namespace App\Facades;

use App\Infrastructure\FacadeAbstract;

final class Session extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return 'session';
    }
}
