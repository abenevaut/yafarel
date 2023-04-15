<?php

use App\Services\Config;
use App\Services\Routes\RESTfulRouter;
use App\Services\Session;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
use Yaf\Application;
use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Loader;
use Yaf\Registry;

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

    public function _initConfig()
    {
        if (!Registry::get('config')) {
            Registry::set('config', Application::app()->getConfig());
        }
    }

    public function _initRouter(Dispatcher $dispatcher)
    {
        if (!$dispatcher->getRequest()->isCli()) {
            $router = new RESTfulRouter($dispatcher->getRouter());
            /** @var array $routes */
            $routes = include(__DIR__ . '/routes.php');

            foreach ($routes as $route) {
                $router->on(...$route);
            }
        }
    }

    public function _initSession(Dispatcher $dispatcher)
    {
        if (!Registry::get('session')) {
            $session = (new Session(
                Config::get('session.name'),
                Config::get('session.domain'),
                Config::get('application.baseUri'),
                Config::get('session.lifetime'),
                Config::get('session.secure'),
                Config::get('session.sameSite')
            ))
                ->start();

            Registry::set('session', $session);
        }
    }

    public function _initTimezone()
    {
        date_default_timezone_set(Config::get('application.timezone'));
    }

    public function _initLogger()
    {
        if (!Registry::get('log')) {
            $logger = (new Logger('default'))
                ->setTimezone(
                    new \DateTimeZone(Config::get('application.timezone'))
                )
                ->pushHandler(
                    (new RotatingFileHandler(
                        Config::get('logger.directory'),
                        Config::get('logger.maxFiles'),
                        Level::fromName(Config::get('logger.level'))
                    ))
                    ->setFormatter(new \Monolog\Formatter\LineFormatter(
                        "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
                        'Y-m-d H:i:s'
                    ))
                )
                ->pushProcessor(function ($record) {
                    $record->extra['sessionId'] = Session::sessionId();
                    $record->extra['userId'] = Session::userId();
                    $record->extra['hit'] = uniqid();

                    return $record;
                });

            Registry::set('log', $logger);
        }
    }

    public function _initDatabase(Dispatcher $dispatcher)
    {
        if (!Registry::get('db')) {
            $capsule = new EloquentCapsule();

            foreach (Config::get('database')->toArray() as $dbName => $config) {
                $capsule->addConnection($config, $dbName);
            }

            $capsule->bootEloquent();

            if (!\App\Services\Environment::isProduction()) {
                \Illuminate\Database\Eloquent\Model::preventLazyLoading();
            }

            Registry::set('db', $capsule);
        }
    }

    public function _initPlugin(Dispatcher $dispatcher)
    {
        $middlewares = include(__DIR__ . '/middlewares.php');
        foreach ($middlewares as $middleware) {
            $dispatcher->registerPlugin(new $middleware);
        }
    }
}
