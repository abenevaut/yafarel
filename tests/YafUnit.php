<?php

namespace Tests;

use Yaf\Application;
use Yaf\Registry;
use Yaf\Request\Http;
use Yaf\Response_Abstract as HttpResponse;
use Yaf\View\Simple as ViewSimple;

trait YafUnit
{
    public function getApplication(): Application
    {
        return Registry::get('application');
    }

    public function getView(): ViewSimple
    {
        return Registry::get('view');
    }

    public function get(string $uri): HttpResponse
    {
        $request = new Http($uri);

        return $this
            ->getApplication()
            ->getDispatcher()
            ->dispatch($request);
    }

    protected function createApplication(): self
    {
        if (!Registry::get('application')) {
            Registry::set('application', new Application(PROJECT_PATH . '/app.ini'));
            Registry::set('view', new ViewSimple(PROJECT_PATH . '/app/views'));

            $this->getApplication()->bootstrap();
            $this->getApplication()->getDispatcher()->autoRender(false);
            $this->getApplication()->getDispatcher()->flushInstantly(false);
            $this->getApplication()->getDispatcher()->returnResponse(true);
            $this->getApplication()->getDispatcher()->setView($this->getView());
        }

        return $this;
    }
}
