<?php

use App\Services\Config;
use App\Services\Environment;
use App\Services\Routes\RESTfulRouter;
use App\Services\Session;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
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
        date_default_timezone_set('Europe/Paris');

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
        if (
            (
                /*
                 * Session have to be setup for unit tests
                 */
                !$dispatcher->getRequest()->isCli()
                OR !Environment::isProduction()
            )
            && !Registry::get('session')
        ) {
            $session = new Session(
                Config::get('session.name'),
                Config::get('session.domain'),
                Config::get('application.baseUri'),
                Config::get('session.lifetime'),
                Config::get('session.secure'),
                Config::get('session.samesite')
            );

            $session->start();

            Registry::set('session', $session);
        }
    }

    public function _initLogger()
    {
        if (!Registry::get('log')) {
            $logger = (new Logger('default'))
                ->pushHandler(
                    new RotatingFileHandler(
                        Config::get('logger.directory'),
                        Config::get('logger.maxFiles'),
                        Level::fromName(Config::get('logger.level'))
                    )
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

//            $capsule->addConnection(
//                [
//                    'driver'    => 'mysql',
//                    'host'      => 'localhost',
//                    'database'  => 'illuminate_non_laravel',
//                    'username'  => 'root',
//                    'password'  => '',
//                    'charset'   => 'utf8',
//                    'collation' => 'utf8_unicode_ci',
//                    'prefix'    => '',
//                ],
//                'mysql'
//            );

            $capsule->addConnection([
                'driver'    => 'sqlite',
                'database' => PROJECT_PATH . '/database.sqlite',
                'prefix' => '',
            ]);

            $capsule->bootEloquent();

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
