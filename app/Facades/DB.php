<?php

namespace App\Facades;

use App\Infrastructure\FacadeAbstract;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;

final class DB extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return EloquentCapsule::class;
    }
}
