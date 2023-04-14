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

    public function get(string $uri, array $params = []): HttpResponse
    {
        $request = new Http($uri);
        $request->method = 'get';

        $_GET = array_merge($_GET, $params);

        return $this
            ->getApplication()
            ->getDispatcher()
            ->dispatch($request);
    }

    public function post(string $uri, array $params = []): HttpResponse
    {
        $request = new Http($uri);
        $request->method = 'post';

        // Force the use of router fallback in testing mode
        $_POST['_method'] = 'post';
        $_POST = array_merge($_POST, $params);

        return $this
            ->getApplication()
            ->getDispatcher()
            ->dispatch($request);
    }

    public function put(string $uri, array $params = []): HttpResponse
    {
        $request = new Http($uri);
        $request->method = 'put';

        // Force the use of router fallback in testing mode
        $_POST['_method'] = 'put';
        $_POST = array_merge($_POST, $params);

        return $this
            ->getApplication()
            ->getDispatcher()
            ->dispatch($request);
    }

    public function delete(string $uri, array $params = []): HttpResponse
    {
        $request = new Http($uri);
        $request->method = 'delete';

        // Force the use of router fallback in testing mode
        $_POST['_method'] = 'delete';
        $_POST = array_merge($_POST, $params);

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
