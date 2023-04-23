<?php

namespace App\Infrastructure;

use Yaf\Dispatcher;
use Yaf\Registry;

abstract class ProviderAbstract
{
    public function __construct(protected Dispatcher $dispatcher) {}

    abstract public function boot(): self;

    protected function bind(string $serviceName, \Closure $serviceInstance): self
    {
        if (Registry::get($serviceName)) {
            throw new \Exception("Service {$serviceName} already registered.");
        }

        Registry::set($serviceName, $serviceInstance());

        return $this;
    }

    protected function singleton(string $serviceName, \Closure $serviceInstance): self
    {
        if (Registry::get($serviceName)) {
            throw new \Exception("Service {$serviceName} already registered.");
        }

         if (Registry::get(md5($serviceName))) {
            throw new \Exception("Service {$serviceName} already instantiated.");
        }

        Registry::set($serviceName, $serviceInstance);

        return $this;
    }
}
