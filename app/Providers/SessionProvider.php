<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\Session;

final class SessionProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $this->bind('session', function () {
            $config = $this->dispatcher->getApplication()->getConfig();

            return (new Session(
                $config->get('session.name'),
                $config->get('session.domain'),
                $config->get('application.baseUri'),
                $config->get('session.lifetime'),
                $config->get('session.secure'),
                $config->get('session.sameSite')
            ))
                ->start()
            ;
        });

        return $this;
    }
}
