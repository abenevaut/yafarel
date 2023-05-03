<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\Session;

final class SessionProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $config = $this->dispatcher->getApplication()->getConfig();

        $this->singleton(Session::class, static function () use ($config) {
            return new Session(
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
