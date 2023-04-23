<?php

namespace App\Services\Router;

use Yaf\Router;

/**
 * RESTful Router
 *
 * credits to https://github.com/rhyzx/yaf-restful
 */
final class RESTfulRouter
{
    private $index = 0;

    public function __construct(
        private Router $router,
        private bool $strict = false
    ) {}

    public function on($method, $path, $controller, $action)
    {
        $this
            ->router
            ->addRoute(
                $this->index++,
                new RESTfulRoute(
                    $path,
                    [
                        'controller' => $controller,
                        'action' => $action,
                        'method' => $method
                    ]
                )
            );
    }
}
