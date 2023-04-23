<?php

namespace App\Facades;

use App\Services\Session as SessionService;
use App\Infrastructure\FacadeAbstract;

final class Session extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return SessionService::class;
    }
}
