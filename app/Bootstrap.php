<?php

use Yaf\Bootstrap_Abstract;
use Yaf\Loader;

final class Bootstrap extends Bootstrap_Abstract
{
    public function _initAutoload()
    {
        Loader::getInstance()->import(PROJECT_PATH . '/vendor/autoload.php');
    }

    public function _initSession(\Yaf\Dispatcher $dispatcher)
    {
        ini_set('session.name', 'my-identity');
    }

    public function _initConfig()
    {

    }

    public function _initPlugin(\Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->registerPlugin(new DisallowFrameEmbeddingPlugin());
    }

    public function _initRoute(\Yaf\Dispatcher $dispatcher)
    {
        //Register your own routing protocol here, by default using a simple route
    }

    public function _initView(\Yaf\Dispatcher $dispatcher)
    {
        //Register your view controller here, for example smarty, firekylin
    }
}
