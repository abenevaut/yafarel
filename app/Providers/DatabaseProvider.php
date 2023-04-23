<?php

namespace App\Providers;

use Environment;
use App\Infrastructure\ProviderAbstract;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;
use Illuminate\Database\Eloquent\Model as EloquentModel;

final class DatabaseProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $this->singleton(EloquentCapsule::class, function () {
            $capsule = new EloquentCapsule();
            $config = $this->dispatcher->getApplication()->getConfig();

            foreach ($config->get('database')->toArray() as $dbName => $dbConfig) {
                $capsule->addConnection($dbConfig, $dbName);
            }

            $capsule->bootEloquent();

            if (!Environment::isProduction()) {
                EloquentModel::preventLazyLoading();
            }

            return $capsule;
        });

        return $this;
    }
}
