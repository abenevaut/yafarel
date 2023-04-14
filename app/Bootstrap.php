<?php

use App\Services\Config;
use App\Services\Session;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;
use Yaf\Bootstrap_Abstract;
use Yaf\Loader;
use Yaf\Registry;

final class Bootstrap extends Bootstrap_Abstract
{
    public function _initAutoload()
    {
        Loader::getInstance()->import(PROJECT_PATH . '/vendor/autoload.php');
    }

    public function _initSession()
    {
        if (!Registry::get('session')) {
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
                    $record->extra['userId'] = Session::userId();
                    $record->extra['hit'] = uniqid();

                    return $record;
                });

            Registry::set('log', $logger);
        }
    }

    public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new DisallowFrameEmbeddingPlugin());
    }
}
