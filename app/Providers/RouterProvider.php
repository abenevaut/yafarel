<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\Router\RESTfulRouter;

final class RouterProvider extends ProviderAbstract
{
    public function boot(): self
    {
        if (!$this->dispatcher->getRequest()->isCli()) {
            /** @var array $routes */
            $routes = include(__DIR__ . '/../routes.php');
            $router = new RESTfulRouter($this->dispatcher->getRouter());

            foreach ($routes as $route) {
                $router->on(...$route);
            }
        }

        return $this;
    }
}
