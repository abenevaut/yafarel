<?php

namespace App\Infrastructure;

use Yaf\Registry;

abstract class SingletonFacadeAbstract extends FacadeAbstract
{
    protected static function getInstance(): mixed
    {
        $instance = Registry::get(md5(static::getFacadeAccessor()));

        // Create instance on first demand
        if (!$instance) {
            $callable = Registry::get(static::getFacadeAccessor());

            if (!$callable) {
                $serviceName = static::getFacadeAccessor();
                throw new \Exception("Service {$serviceName} not registered.");
            }

            $instance = $callable();
            // Register instance to registry
            Registry::set(md5(static::getFacadeAccessor()), $instance);
            // Free \Closure from registry
            Registry::del(static::getFacadeAccessor());
        }

        return $instance;
    }
}
