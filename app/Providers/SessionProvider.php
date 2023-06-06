<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\SessionService;

final class SessionProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $this->singleton(SessionService::class, function () {
            $config = $this->dispatcher->getApplication()->getConfig();

            return new SessionService(
                $config->get('session')->get('name'),
                $config->get('session')->get('domain'),
                $config->get('application')->get('baseUri'),
                $config->get('session')->get('lifetime'),
                $config->get('session')->get('secure'),
                $config->get('session')->get('sameSite')
            );
        });

        return $this;
    }
}
