<?php

namespace App\Facades;

use App\Infrastructure\FacadeAbstract;
use Monolog\Logger;

final class Log extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return Logger::class;
    }
}
