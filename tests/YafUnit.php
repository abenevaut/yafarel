<?php

namespace Tests;

use Yaf\Application;
use Yaf\Registry;
use Yaf\Request\Http;
use Yaf\Response_Abstract as HttpResponse;
use Yaf\View\Simple as ViewSimple;

trait YafUnit
{
    public static ?Application $app = null;
    public static ?ViewSimple $viewEngine = null;

    public function getApplication(): Application
    {
        return self::$app;
    }

    public function getView(): ViewSimple
    {
        return self::$viewEngine;
    }

    public function get(string $uri): HttpResponse
    {
        $request = new Http('/');

        return $this
            ->getApplication()
            ->getDispatcher()
            ->dispatch($request);
    }

    protected function createApplication(): self
    {
        if (!Registry::get('ApplicationInit')) {
            self::$app = new Application(PROJECT_PATH . '/app.ini');
            self::$viewEngine = new ViewSimple(PROJECT_PATH . '/app/views');

            $this->getApplication()->bootstrap();
            $this->getApplication()->getDispatcher()->autoRender(false);
            $this->getApplication()->getDispatcher()->flushInstantly(false);
            $this->getApplication()->getDispatcher()->returnResponse(true);
            $this->getApplication()->getDispatcher()->setView($this->getView());

            Registry::set( 'ApplicationInit', true );
        }

        return $this;
    }
}
