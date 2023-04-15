<?php

namespace App\Services;

use Yaf\Registry;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;

final class DB
{
    private EloquentCapsule $capsule;

    public function __construct(array $dbConfig)
    {
        $this->capsule = new EloquentCapsule();
        $this->setupConnection($dbConfig);
        $this->capsule->bootEloquent();
    }

    private function setupConnection(array $dbConfig): void
    {
        foreach ($dbConfig as $database => $config) {
            $this
                ->capsule
                ->addConnection($dbConfig, $database);
        }
    }
}
