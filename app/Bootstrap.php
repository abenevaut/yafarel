<?php

use Yaf\Bootstrap_Abstract;
use Yaf\Loader;

final class Bootstrap extends Bootstrap_Abstract
{
    public function _initAutoload()
    {
        Loader::getInstance()->import(PROJECT_PATH . '/vendor/autoload.php');
    }

    public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new DisallowFrameEmbeddingPlugin());
    }
}
