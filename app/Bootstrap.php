<?php

use App\Providers\DatabaseProvider;
use App\Providers\LoggerProvider;
use App\Providers\RouterProvider;
use App\Providers\SessionProvider;
use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Loader;

/**
 * Class Bootstrap
 *
 * \Yaf\Application::bootstrap() will call all _init* methods defined in Bootstrap top to down.
 * Be free to add your own _init* methods.
 */
final class Bootstrap extends Bootstrap_Abstract
{
    public function _initAutoload()
    {
        Loader::getInstance()->import(PROJECT_PATH . '/vendor/autoload.php');
    }

    public function _initTimezone(Dispatcher $dispatcher)
    {
        date_default_timezone_set(
            $dispatcher->getApplication()->getConfig()->get('application.timezone')
        );
    }

    public function _initServices(Dispatcher $dispatcher)
    {
        $services = include(__DIR__ . '/services.php');
        foreach ($services as $service) {
            (new $service($dispatcher))->boot();
        }
    }

    public function _initPlugins(Dispatcher $dispatcher)
    {
        $middlewares = include(__DIR__ . '/middlewares.php');
        foreach ($middlewares as $middleware) {
            $dispatcher->registerPlugin(new $middleware);
        }
    }
}
