<?php

namespace App\Providers;

use RESTfulRouter;
use App\Infrastructure\ProviderAbstract;

final class RouterProvider extends ProviderAbstract
{
    public function boot(): self
    {
        /** @var array $routes */
        $routes = include(__DIR__ . '/../routes.php');
        $router = new RESTfulRouter($this->dispatcher->getRouter());

        foreach ($routes as $route) {
            $router->on(...$route);
        }

        return $this;
    }
}
