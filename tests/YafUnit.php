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
        return Registry::get('app');
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
        return $this->dispatchPost(__FUNCTION__, $uri, $params);
    }

    public function put(string $uri, array $params = []): HttpResponse
    {
        return $this->dispatchPost(__FUNCTION__, $uri, $params);
    }

    public function delete(string $uri, array $params = []): HttpResponse
    {
        return $this->dispatchPost(__FUNCTION__, $uri, $params);
    }

    private function dispatchPost(string $method, string $uri, array $params = []): HttpResponse
    {
        $request = new Http($uri);
        $request->method = $method;

        // Force the use of router fallback during testing
        $_POST['_method'] = $method;
        $_POST = array_merge($_POST, $params);

        return $this
            ->getApplication()
            ->getDispatcher()
            ->dispatch($request);
    }

    private function createApplication(string $configFilePath, string $viewsPath): self
    {
        if (!Registry::get('app')) {
            Registry::set('app', new Application($configFilePath));
            Registry::set('view', new ViewSimple($viewsPath));

            $this->getApplication()->bootstrap();
            $this->getApplication()->getDispatcher()->autoRender(false);
            $this->getApplication()->getDispatcher()->flushInstantly(false);
            $this->getApplication()->getDispatcher()->returnResponse(true);
            $this->getApplication()->getDispatcher()->setView($this->getView());
        }

        return $this;
    }
}
