<?php

namespace App\Services;

use Yaf\Registry;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;

final class DB
{
    private static function get(): EloquentCapsule
    {
        return Registry::get('db');
    }
}
