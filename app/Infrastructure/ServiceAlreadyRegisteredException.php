<?php

namespace App\Infrastructure;

class ServiceAlreadyRegisteredException extends \Exception
{
    public function __construct(string $serviceName)
    {
        parent::__construct("Service {$serviceName} already registered.");
    }
}
