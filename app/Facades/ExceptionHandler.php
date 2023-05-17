<?php

namespace App\Facades;

use App\Infrastructure\FacadeAbstract;
use App\Services\ExceptionHandlerService;

final class ExceptionHandler extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return ExceptionHandlerService::class;
    }
}
