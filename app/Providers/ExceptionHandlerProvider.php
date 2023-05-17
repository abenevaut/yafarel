<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\ExceptionHandlerService;

final class ExceptionHandlerProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $request = $this->dispatcher->getRequest();

        $this->singleton(ExceptionHandlerService::class, function () use ($request) {
            return new ExceptionHandlerService(
                \Environment::isProduction(),
                $request->isCli(),
                $request->isXmlHttpRequest()
            );
        });

        return $this;
    }
}
