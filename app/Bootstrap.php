<?php

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

    public function _initLogger()
    {
        if (!Registry::get('log')) {
            $logger = (new Logger('default'))
                ->pushHandler(new RotatingFileHandler(PROJECT_PATH . '/logs/log.log', 0, Level::Debug));

            Registry::set('log', $logger);
        }
    }

    public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new DisallowFrameEmbeddingPlugin());
    }
}
